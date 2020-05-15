<?php
// Get credentials
include_once "connect.db.php";

// Create connection
//$db = mysqli_connect($server, $user, $password, $database);
$db = mysqli_connect("anysql.itcollege.ee", "WT8", "CJuPlun24D", "WT8");
// Check connection
if(!$db) die("Connnection to DB failed: " . mysqli_connect_error());

function listCourses($sID, $search, $order){

    //P - shittiest
    //H - lanugage
    //P - ever
    global $db;

    $query = "SELECT course_code, course_name, ects_credits, semester_name, Semesters_ID FROM courses C LEFT JOIN semesters_arch S ON C.Semesters_ID=S.ID WHERE Semesters_ID='$sID' AND ( course_name LIKE '%$search%' OR course_code LIKE '%$search%' )".$order;
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0){

        printf("<table> <tr> <th>Code</th> <th>Name</th> <th>Credits</th> <th>Semester</th> </tr>");
        while($row = mysqli_fetch_array($result)){
            printf("<tr> <td>%s</td> <td>%s</td> <td><strong>%s</strong></td> <td>%s</td> </tr>", $row['course_code'], $row['course_name'], $row['ects_credits'], $row['semester_name']);
        }
        printf("</table>");
    }
}

function semestrator(){

    global $db;

    $query = "SELECT * FROM semesters_arch";
    $result = mysqli_query($db, $query);

    printf("<ul>");
    while($row = mysqli_fetch_array($result)){
        printf("<li><a href=index.php?semester=%s>%s</a></li>", $row['ID'], $row['semester_name']);
    }
    printf("</ul>");

    if(isset($_GET['semester'])){
        $semester = mysqli_real_escape_string($db, $_GET['semester']);

        printf("<form method=POST> <input name=search> <select name=order> <option value='ORDER BY ects_credits DESC'>Descending</option> <option value=' ORDER BY ects_credits ASC'>Ascending</option> </select> <input type=submit> </form>");

        $search = '';
        if(isset($_POST['search'])){
            $search = $_POST['search'];
        }

        $order = '';
        if(isset($_POST['order'])){
            $order = $_POST['order'];
        }
        listCourses($semester, $search, $order);
    }
}

semestrator();
//listCourses();
?>