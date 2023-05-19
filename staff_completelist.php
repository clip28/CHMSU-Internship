<?php


// This is the code which brings out pending list for approval
                                    $query2 = "SELECT applicants.appID, student.STUDENT_ID, student.NAME, student.COURSE, jobs.Job_Title, industry.COMPANY_NAME, jobs.Category, jobs.Vacancy, applicants.Proof, industry.CONTACT_NO, applicants.Status
                                        from applicants
                                        inner join student on student.STUDENT_ID = applicants.STUDENT_ID
                                        inner join jobs on jobs.Job_ID = applicants.Job_ID
                                        inner join industry on industry.REGIS_NO=jobs.REGIS_NO
                                        where applicants.Status = 'Ending'";
                                    $query_run2 = mysqli_query($connection, $query2);
                                   




                         if(isset($_POST['Apply2'])) {
                                 $fID = $_POST['Apply2'];  // approve
                            
                                 $endDate = date("Y-m-d");
                                

                                $apply2 = " UPDATE applicants
                                  SET Status='Ended'
                                 WHERE appID ='$fID'";       // updating confirmation status

                                 mysqli_query($connection, $apply2);    //Excecute query

                                 //updating the status in student table

                                  $que2 = "SELECT * from applicants where appID='$fID'";
                                 $que_run2 = mysqli_query($connection, $que2);
                                  $info2 = mysqli_fetch_assoc($que_run2);
                                 $stu_info2 = $info2['STUDENT_ID'];


                                 $enroll = " UPDATE student
                                                SET ENROLL='Ended'
                                                WHERE STUDENT_ID ='$stu_info2'"; 
   
                                                $trial =  mysqli_query($connection, $enroll);    //Excecute query



                                $fdetails = "SELECT a.appID, a.Status, s.STUDENT_ID, s.NAME, s.STUDENT_EMAIL, s.COURSE, s.SUPERVISOR, s.YEAR_OF_STUDY, i.COMPANY_NAME, i.WEBSITE, i.Email,j.Job_ID,j.REGIS_NO, j.Job_Title, j.Position, a.Date_Applied from student s inner join applicants a on s.STUDENT_ID = a.STUDENT_ID inner join jobs j on a.Job_ID = j.Job_ID inner join industry i on j.REGIS_NO = i.REGIS_NO 
                                    where a.STUDENT_ID = '$stu_info2' and a.Status = 'Ended' and a.appID = '$fID'";


                                $fdata = mysqli_query($connection, $fdetails);

                                 if ($fdata) {

                                        foreach ($fdata as $x) {



                                        

                                            $studentid = $x['STUDENT_ID'];
                                            $studentname = $x['NAME'];
                                            $studentemail = $x['STUDENT_EMAIL'];
                                            $studentcourse = $x['COURSE'];
                                            $studentvisor = $x['SUPERVISOR'];
                                            $studentyos = $x['YEAR_OF_STUDY'];
                                            $companyname = $x['COMPANY_NAME'];
                                            $companywebsite = $x['WEBSITE'];
                                            $companyemail = $x['Email'];
                                            $jobtitle = $x['Job_Title'];
                                            $jobposition = $x['Position'];
                                            $dateApplied = $x['Date_Applied'];
                                            $jobid = $x['Job_ID'];
                                            
                                            $cregis = $x['REGIS_NO'];
                                           
                            
                                          
                                            $completedate = $endDate;
                                        }
                                    }

                                else{
                                    echo "didnt work";
                                }


                                $stmt = mysqli_stmt_init($connection); //initialize connection to statement

                                $run = "INSERT INTO history (Student_id, Student_NAME, STUDENT_EMAIL, COURSE, SUPERVISOR, YEAR_OF_STUDY, COMPANY_NAME, WEBSITE, Email, Job_Title, Position, Date_Applied, Completion_date, Job_ID, REGIS_NO) 
                                VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?)";

                                mysqli_stmt_prepare($stmt, $run);
                                mysqli_stmt_bind_param($stmt, 'sssssssssssssss',  $studentid, $studentname, $studentemail, $studentcourse, $studentvisor, $studentyos, $companyname, $companywebsite, $companyemail, $jobtitle, $jobposition, $dateApplied, $completedate, $jobid, $cregis);
                                $insert = mysqli_stmt_execute($stmt);




                                if(!$insert){
                                    echo "couldnt insert";
                                }else{
                                    echo "works fine";
                                }

                                mysqli_stmt_close($stmt);
                                mysqli_close($connection);









                             header("Location:staff_approval.php");
                                              
                                    }else{

                                        if(isset($_POST['Cancel2'])) {
                                         $fID = $_POST['Cancel2'];  // approve
                                

                                           //update application table
                                             $apply2 = " UPDATE applicants
                                             SET Status ='Confirmed'
                                             WHERE appID ='$fID'";       // updating confirmation status
           
                                            $y =    mysqli_query($connection, $apply2);    //Excecute query

                                          

                                              //update student table

                                          $que2 = "SELECT * from applicants where appID='$fID'";
                                          $que_run2 = mysqli_query($connection, $que2);
                                           $info2 = mysqli_fetch_assoc($que_run2);
                                          $stu_info2 = $info2['STUDENT_ID'];

                                           $apply2 = " UPDATE student
                                             SET ENROLL='Confirmed'
                                              WHERE STUDENT_ID ='$stu_info2'";       // updating confirmation status
           
                                            $t =   mysqli_query($connection, $apply2);    //Excecute query

                                                
                                           header("Location:staff_approval.php");
                                                        
                                                          
                                                    }
                                                     
                                            }






?>