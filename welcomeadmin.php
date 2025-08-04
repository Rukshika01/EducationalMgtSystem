<!DOCTYPE html>
<html>
<head>


    <style>
        
	.site-footer
{
  background-color:#26272b;
  padding:45px 0 20px;
  font-size:15px;
  line-height:24px;
  color:#737373;
}
.site-footer hr
{
  border-top-color:#bbb;
  opacity:0.5
}
.site-footer hr.small
{
  margin:20px 0
}
.site-footer h6
{
  color:#fff;
  font-size:16px;
  text-transform:uppercase;
  margin-top:5px;
  letter-spacing:2px
}
.site-footer a
{
  color:#737373;
}
.site-footer a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links
{
  padding-left:0;
  list-style:none
}
.footer-links li
{
  display:block
}
.footer-links a
{
  color:#737373
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links.inline li
{
  display:inline-block
}
.site-footer .social-icons
{
  text-align:right
}
.site-footer .social-icons a
{
  width:40px;
  height:40px;
  line-height:40px;
  margin-left:6px;
  margin-right:0;
  border-radius:100%;
  background-color:#33353d
}
.copyright-text
{
  margin:0
}
@media (max-width:991px)
{
  .site-footer [class^=col-]
  {
    margin-bottom:30px
  }
}
@media (max-width:767px)
{
  .site-footer
  {
    padding-bottom:0
  }
  .site-footer .copyright-text,.site-footer .social-icons
  {
    text-align:center
  }
}
.social-icons
{
  padding-left:0;
  margin-bottom:0;
  list-style:none
}
.social-icons li
{
  display:inline-block;
  margin-bottom:4px
}
.social-icons li.title
{
  margin-right:15px;
  text-transform:uppercase;
  color:#96a2b2;
  font-weight:700;
  font-size:13px
}
.social-icons a{
  background-color:#eceeef;
  color:#818a91;
  font-size:16px;
  display:inline-block;
  line-height:44px;
  width:44px;
  height:44px;
  text-align:center;
  margin-right:8px;
  border-radius:100%;
  -webkit-transition:all .2s linear;
  -o-transition:all .2s linear;
  transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
  color:#fff;
  background-color:#29aafe
}
.social-icons.size-sm a
{
  line-height:34px;
  height:34px;
  width:34px;
  font-size:14px
}
.social-icons a.facebook:hover
{
  background-color:#3b5998
}
.social-icons a.twitter:hover
{
  background-color:#00aced
}
.social-icons a.linkedin:hover
{
  background-color:#007bb6
}
.social-icons a.dribbble:hover
{
  background-color:#ea4c89
}
@media (max-width:767px)
{
  .social-icons li.title
  {
    display:block;
    margin-right:0;
    font-weight:600
  }
}
        .test {
            flex: 1;
            text-decoration: none;
            outline-color: transparent;
            text-align: center;
            line-height: 3;
            color: black;
            font-family: sans-serif;
            border: none;
        }

        .test {
            background-color: #ebdbc7;
            color: black;
        }

        .test:hover {
            background: orange;
        }

        .test:active {
            background: darkred;
            color: white;
        }
    </style>
</head>

<body>
    <?php include('adminhead.php'); ?>
    <br>
    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <!-- Link to Student Details section -->
            <a href="#studentdetails"><button type="button" class="test" style="border-radius:0%"><i class="fa fa-graduation-cap"></i> Student Details</button></a>

            <!-- Link to Faculty Details section -->
            <a href="#facultydetails"><button type="button" class="test" style="border-radius:0%"><i class="fa fa-users"></i> Faculty Details</button></a>

            <!-- Link to Subject Details section -->
            <a href="#subjectsdetails"><button type="button" class="test" style="border-radius:0%"><i class="fa fa-book"></i>Subjects Details</button></a>
            <a href="#parentdetails"><button type="button" class="test" style="border-radius:0%"><i class="fa fa-book"></i>Parent Details</button></a>
            <a href="guestdetails"><button type="button" class="test" style="border-radius:0%"><i class="fa fa-user"></i> Manage Guest</button></a>
        </div>
    </div>
    <br>

    <div id="studentdetails" class="container">
        <!-- Student Details Section -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Student Details
                    
                </h2>
                <?php
                include("database.php");
                $sql = "SELECT * from studenttable";
                $result = mysqli_query($connect, $sql);
                echo "<table id='studentTable' class='table table-striped table-hover' style='width:100%'>
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Enrolment</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>";
                $count = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['Eno']; ?></td>
                        <td><?php echo $row['FName'] . " " . $row['LName']; ?></td>
                        <td><?php echo $row['FaName']; ?></td>
                        <td><?php echo $row['Addrs']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['DOB']; ?></td>
                        <td><?php echo $row['PhNo']; ?></td>
                        <td><?php echo $row['Eid']; ?></td>
                        <td><a href="updatestudent.php?eno=<?php echo $row['Eno']; ?>"><input type="button" value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"></a></td>
                    </tr>
                    <?php $count++;
                } ?>
                 </tbody>
                </table>
            </div>
        </div>
        <a href="addnewstudent"><button type="button" value="AddNewStudent" style="border-radius:0%; align-content:center; background-color: #ebdbc7; font-weight: 700;">Add New Student</button></a>
    </div>

    <div id="facultydetails" class="container">
        <!-- Faculty Details Section -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Faculty Details
                </h2>
                <?php
                include("database.php");
                $sql = "SELECT * from facutlytable";
                $result = mysqli_query($connect, $sql);
                echo "<table id='facultyTable' class='table table-striped table-hover' style='width:100%'>
                <thead>
                    <tr>
                    <th>#</th>
                    <th>FullName</th>
                    <th>Father Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Joining Date</th>
                    <th>City</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>";
                $count = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['FName']; ?></td>
                        <td><?php echo $row['FaName']; ?></td>
                        <td><?php echo $row['Addrs']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['JDate']; ?></td>
                        <td><?php echo $row['City']; ?></td>
                        <td><?php echo $row['PhNo']; ?></td>
                        <td><a href="updatefaculty.php?fid=<?php echo $row['FID']; ?>"><input type="button" value="Edit" style="border-radius:0%" class="btn btn-success btn-sm"></a></td>
                    </tr>
                    <?php $count++;
                } ?>
                </tbody>
                </table>
            </div>
        </div>
        <a href="addnewfaculty"><button type="button" value="Add New Faculty" style="border-radius:0%; align-content:center; background-color: #ebdbc7; font-weight: 700;">Add New Faculty</button></a>
    </div>

    <div id="subjectsdetails" class="container">
        <!-- Subject Details Section -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Subject Details
                </h2>
                <?php
                include("database.php");
                $sql = "SELECT * from subjects";
                $result = mysqli_query($connect, $sql);
                echo "<table id='subjectsTable' class='table table-striped table-hover' style='width:100%'>
                <thead>
                    <tr>
                    <th>#</th>
                    <th>subject id</th>
                    <th>subject name</th>
                    <th>subject code</th>
                    <th>description</th>
                    <th>teacher ID</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>";
                $count = 1;
                $found = false;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['sub_id']; ?></td>
                        <td><?php echo $row['sub_name']; ?></td>
                        <td><?php echo $row['sub_code']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['FID']; ?></td>
                        <td><a href="updatesubject.php?sub_id=<?php echo $row['sub_id']; ?>"><input type="button" Value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"></a></td>
                    </tr>
                
                    <?php $count++; $found = true;
                }
                if (!$found) {
                    echo "<tr class='no-results'><td colspan='7'>No results found</td></tr>";
                }
                ?>
                </tbody>
                </table>
            </div>
        </div>
        <a href="addnewsubject"><button type="button" value="AddNewsubject" style="border-radius:0%; align-content:center; background-color: #ebdbc7; font-weight: 700;">Add New Subject</button></a>
    </div>

    <div id="parentdetails" class="container">
        <!-- Student Details Section -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Parent Details
                    
                </h2>
                <?php
                include("database.php");
                $sql = "SELECT * from parent";
                $result = mysqli_query($connect, $sql);?>
                
                <table id='parentTable' class='table table-striped table-hover' style='width:100%'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Parent ID</th>
                            <th>Name</th>            
                            <th>Phone Number</th>
                            <th>Student Enrollment No.</th>
                            <th>Email</th>                   
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php    
                $count = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['parent_id']; ?></td>
                        <td><?php echo $row['parent_name']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['Eno']; ?></td>
                        <td><?php echo $row['p_email']; ?></td>
                        
                        <td><a href="updateparent.php?parent_id=<?php echo  $row['parent_id']; ?>"><input type="button" value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"></a></td>
                    </tr>
                
                    <?php $count++;
                } ?>
                </tbody>
                </table>
                
            </div>
        </div>
        <a href="addnewparent"><button type="button" value="AddNewParent" style="border-radius:0%; align-content:center; background-color: #ebdbc7; font-weight: 700;">Add New Parent</button></a>
    </div>
    <br>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

                <script>
                    $(document).ready( function () {
                        $('#subjectsTable').DataTable();
                        $('#parentTable').DataTable();
                        $('#facultyTable').DataTable();
                        $('#studentTable').DataTable();
                    } );
                </script>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">Edu Dive is designed to provide you with the tools and resources you need to succeed in your educational journey. Whether you're a student looking to supplement your studies or a professional seeking to expand your skillset, Edu Dive offers high-quality content curated by experts in their fields.</p>
                </div>
                <div class="col-xs-6 col-md-3">
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Contacts</h6>
                    <ul class="contact-list">
                        <li>+94768392748</li>
                        <li>edudive@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="copyright" style="text-align: center;">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i
                            class="fa fa-heart-o" aria-hidden="true"></i> by Edu Dive</div>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>

