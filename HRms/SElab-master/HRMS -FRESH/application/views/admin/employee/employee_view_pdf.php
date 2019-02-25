<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
    </head>

    <body style="width: 100%;">
        <div style="width: 100%; border-bottom: 2px solid black;">
            <table style="width: 100%; vertical-align: middle;">
                <tr>
                    <?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
                            ?>
                            <td style="width: 35px; border: 0px;">
                                <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                            </td>
                            <td style="border: 0px;">
                                <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                            </td>
                            <?php
                        }
                    } else {
                        ?>
                        <td style="width: 35px; border: 0px;">
                            <img style="width: 50px;height: 50px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle"/>
                        </td>
                        <td style="border: 0px;">
                            <p style="margin-left: 10px; font: 14px lighter;">Human Resource Management System</p>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
        </div>
        <br/>
        <br/>
        <div style="padding: 5px 0; width: 100%;">
            <div>
                <table style="width: 100%; border-radius: 3px;">
                    <tr>
                        <td style="width: 150px;">
                            <table style="border: 1px solid grey;">
                                <tr>
                                    <td style="background-color: lightgray; border-radius: 2px;">
                                        <?php if ($employee_info->photo): ?>
                                            <img src="<?php echo base_url() . $employee_info->photo; ?>" style="width: 132px; height: 138px; border-radius: 3px;" >  
                                        <?php else: ?>
                                            <img alt="Employee_Image">     
                                        <?php endif; ?> 
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width: 300px; margin-left: 10px; margin-bottom: 10px; font-size: 13px;">
                                <tr>
                                    <td colspan="2"><h2><?php echo "$employee_info->first_name " . "$employee_info->last_name"; ?></h2></td>
                                </tr>                                
                                <tr>
                                    <td style="width: 100px"><strong>Employee ID : </strong></td>
                                    <td colspan="2"><?php echo "$employee_info->employment_id "; ?></td>
                                </tr>                                
                                <tr>
                                    <td style="width: 100px"><strong>Department : </strong></td>
                                    <td>&nbsp; <?php echo "$employee_info->department_name"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px"><strong>Designation :</strong> </td>
                                    <td>&nbsp; <?php echo "$employee_info->designations"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px"><strong>Joining Date: </strong></td>
                                    <td>&nbsp; <?php echo date('d M Y', strtotime($employee_info->joining_date)); ?></td>
                                </tr>                                                                          
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--        <hr style="margin-top: 10px; margin-bottom: 10px;" />-->

        <div style="width: 100%; margin-top: 55px;">

            <div >
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Personal Details</strong></p>
                </div>
                <br />
                <table style="width: 100%; /*border: 1px solid blue;*/ padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="width: 30%;text-align: right"><strong>Date of Birth :</strong></td>

                                    <td style="">&nbsp; <?php echo date('d M Y', strtotime($employee_info->date_of_birth)); ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right"><strong>Gender :</strong></td>

                                    <td style="width: 220px;">&nbsp; <?php echo "$employee_info->gender"; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right;"><strong>Maratial Status :</strong></td>

                                    <td style="width: 220px;">&nbsp; <?php echo "$employee_info->maratial_status"; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><strong>Father's Name :</strong></td>

                                    <td style="width: 220px;">&nbsp; <?php echo "$employee_info->father_name"; ?></td>
                                </tr>                                
                            </table>
                        </td>
                    </tr>
                </table>
                <br />
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Contact Details</strong></p>
                </div>                            
                <table style="width: 100%; margin-top: 20px; padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="width: 30%;text-align: right;"><strong>Email :</strong></td>

                                    <td style="">&nbsp; <?php echo "$employee_info->email"; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right;"><strong>Phone :</strong></td>

                                    <td style="">&nbsp; <?php echo "$employee_info->phone"; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right"><strong>Mobile :</strong></td>

                                    <td style="">&nbsp; <?php echo "$employee_info->mobile"; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><strong>Present Address :</strong></td>

                                    <td style="">&nbsp; <?php echo "$employee_info->present_address"; ?></td>
                                </tr>                                                          
                                <tr>
                                    <td style="text-align: right;"><strong>City :</strong></td>

                                    <td>&nbsp; <?php echo "$employee_info->city"; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right;"><strong>Country :</strong></td>

                                    <td style="">&nbsp; <?php echo "$employee_info->countryName"; ?></td>
                                </tr>                            
                            </table>
                        </td>
                    </tr>
                </table>
                <br />
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Bank Information</strong></p>
                </div>            
                <table style="width: 100%; margin-top: 20px; padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="font-size: 13px;width: 100%">
                                <tr>
                                    <td style="width: 30%;text-align: right"><strong>Bank Name : </strong> </td>
                                    <td style="">&nbsp; <?php echo $employee_info->bank_name; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right"><strong>Branch Name :</strong></td>

                                    <td>&nbsp;<?php echo "$employee_info->branch_name"; ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right"><strong>Account Name :</strong></td>

                                    <td>&nbsp;<?php echo "$employee_info->account_name"; ?></td>
                                </tr>                                
                                <tr>
                                    <td style="text-align: right"><strong>Account Number :</strong></td>

                                    <td>&nbsp;<?php echo "$employee_info->account_number"; ?></td>
                                </tr>                            
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>          
    </body>
</html>