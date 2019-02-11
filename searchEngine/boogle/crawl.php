<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/7/2019
 * Time: 2:55 AM
 */


include("config.php");
include("classes/DomDocumentParser.php");

if (isset($_GET["go"])) {
    $urlValue = $_GET["urlValue"];
}

?>


<html>
<head>
    <title>Web Crawler By DenVa36</title>

    <meta name="description" content="Search the web for sites and images and stores in database.">
    <meta name="keywords" content="Web Crawler, DenVa36, websites">
    <meta name="author" content="Chy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<div class="wrapper indexPage">
    <div class="mainSection">

        <div class="logoContainerC">
            <img src="assets/images/denvaLogo.png" title="Logo of our site" alt="denVa36 webCrawler">
        </div>

        <div class="wrapper indexPage">
            <div class="mainSection">
                <div class="searchContainer" style="justify-content: center; display: flex;">
                    <form action="crawl.php" method="get">
                        <input class="searchBox" style="width: 900px;" type="text" name="urlValue" value="http://www.">
                        <input class="searchButton" type="submit" name="go">
                    </form>
                </div>
            </div>
        </div>


        <fieldset class="searchBox"
                  style="justify-content: center; border-color: #FAFAFA; border-width: 5px; border-radius: 10px; ">


            <?php

            $alreadyCrawled = array();
            $crawling = array();
            $alreadyFoundImages = array();


            // filtering existing links
            function linkExists($url)
            {
                global $con;

                $query = $con->prepare("SELECT * FROM sites WHERE url = :url");
                $query->bindParam(":url", $url);
                $query->execute();

                return $query->rowCount() != 0;
            }


            // using prepared statements, you prepare the statement first then you bind the parameters
            function insertLink($url, $title, $description, $keywords)
            {
                global $con;

                $query = $con->prepare("INSERT INTO sites(url, title, description, keywords)
                                     VALUES (:url, :title, :description, :keywords)");

                $query->bindParam(":url", $url);
                $query->bindParam(":title", $title);
                $query->bindParam(":description", $description);
                $query->bindParam(":keywords", $keywords);

                return $query->execute();
            }


            // Prepared statement for inserting image
            function insertImage($url, $src, $alt, $title)
            {
                global $con;

                $query = $con->prepare("INSERT INTO images(siteUrl, imageUrl, alt, title)
                                     VALUES (:siteUrl, :imageUrl, :alt, :title)");

                $query->bindParam(":siteUrl", $url);
                $query->bindParam(":imageUrl", $src);
                $query->bindParam(":alt", $alt);
                $query->bindParam(":title", $title);

                return $query->execute();
            }


            // definition of createLink()
            function createLink($src, $url)                                                                                         // url is our main link and src/href is the link we get through the main link
            {
                // This function converts relative links to absolute links
                // scheme = http https
                // host: www.apple.com as an example
                $scheme = parse_url($url)["scheme"];
                $host = parse_url($url)["host"];


                if (substr($src, 0, 2) == "//") {                                                                       // for handling--- //www.website.com -> http://www.website.com
                    $src = $scheme . ":" . $src;
                } elseif (substr($src, 0, 1) == "/") {                                                                  // for handling--- /about/aboutUs.com -> http://www.website/about/aboutUs.com
                    $src = $scheme . "://" . $host . $src;
                } elseif (substr($src, 0, 2) == "./") {                                                                 // for handling--- ./about/aboutUs.com -> http://www.website/about/aboutUs.com
                    $src = $scheme . "://" . $host . dirname(parse_url($url)["path"]) . substr($src, 1);
                } elseif (substr($src, 0, 3) == "../") {                                                                // for handling--- ../about/aboutUs.com -> http://www.website/about/aboutUs.com
                    $src = $scheme . "://" . $host . "/" . $src;
                } elseif (substr($src, 0, 5) != "https" && substr($src, 0, 4) != "http") {                  // for handling--- about/aboutUs.com -> http://www.website/about/aboutUs.com
                    $src = $scheme . "://" . $host . "/" . $src;
                }


                return $src;

            }

            // definition of getDetails(),
            // linkExists() has been called here,
            // insertLink() has been called here,
            // insertImage() has been called here,
            // createLink() has been called here.
            function getDetails($url)
            {
                global $alreadyFoundImages;
                $parser = new DomDocumentParser($url);

                $titleArray = $parser->getTitleTags();
                $imageArray = $parser->getImages();
                $metasArray = $parser->getMetatags();

                $description = "";
                $keywords = "";


                if (sizeof($titleArray) == 0 || $titleArray->item(0) == NULL) {
                    return;
                }


                $title = $titleArray->item(0)->nodeValue;
                $title = str_replace("\n", "", $title);


                if ($title == "") {
                    return; //$title = $url;
                }


                foreach ($metasArray as $meta) {
                    if ($meta->getAttribute("name") == "description") {
                        $description = $meta->getAttribute("content");
                    }
                    if ($meta->getAttribute("name") == "keywords") {
                        $keywords = $meta->getAttribute("content");
                    }
                }


                $description = str_replace("\n", "", $description);
                $keywords = str_replace("\n", "", $keywords);


                //echo "URL: $url, Title: $title, Description: $description, Keywords: $keywords<br>";
                if (linkExists($url)) {
                    echo "<h5>URL already exists: " . $url . "</h5>";
                } elseif (insertLink($url, $title, $description, $keywords)) {
                    echo "<h5>URL stored: " . $url . "</h5>";
                } else {
                    echo "<h5>ERROR: Failed to insert</h5>" . $url . "</h5>";
                }


                foreach ($imageArray as $image) {
                    $src = $image->getAttribute("src");
                    $alt = $image->getAttribute("alt");
                    $title = $image->getAttribute("title");


                    if (!$title && !$alt) {
                        continue;
                    }


                    $src = createLink($src, $url);


                    if (!in_array($src, $alreadyFoundImages)) {
                        $alreadyFoundImages[] = $src;

                        echo "ImageINSERTED: " . insertImage($url, $src, $alt, $title);
                    }

                }

            }


            // definition of followLink(),
            // createLink() has been called here,
            // followLink() has been called here recursively.
            function followLink($url)
            {
                global $alreadyCrawled;
                global $crawling;

                $parser = new DomDocumentParser($url);                                                                              // instantiating new object of DomDocumentParser class with constructor
                $linkList = $parser->getlinks();


                foreach ($linkList as $link) {
                    $href = $link->getAttribute("href");


                    if (strpos($href, "#") !== false) {
                        continue;
                    } elseif (substr($href, 0, 11) == "javascript:") {
                        continue;
                    }


                    $href = createLink($href, $url);                                                                                // definition of createLink() is residing above


                    if (!in_array($href, $alreadyCrawled)) {
                        $alreadyCrawled[] = $href;
                        $crawling[] = $href;

                        // Insert href
                        getDetails($href);
                    }
                    // else return;
                    // echo $href ."<br>";
                }


                array_shift($crawling);


                foreach ($crawling as $site) {
                    followLink($site);
                }
            }

            @followLink($urlValue);


            // followLinks() was renamed to followLink()


            /*
                   What is a URL directory?
                   URL Directory. Each web page has a URL directory where the URLs are placed hierarchically.
                   The individual files of the website are created in the directories.
                   Individual files could be HTML files, images, videos, or PDF documents, for example.
                   Each web page has a URL directory where the URLs are placed hierarchically.
            */


            // createLink() function has been called two times
            // one time for image url(grabs the source url of the image) and
            // another time for main url

            ?>


        </fieldset>
    </div>
</div>

</body>
</html>