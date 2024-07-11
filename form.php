<?php
include("connection.php");
?>

<?php
if (isset($_POST['searchdata'])) {
   $search =   $_POST['search'];
   $query = "SELECT * FROM  FORM where id = '$search' ";
   $data = mysqli_query($conn , $query);
   $result = mysqli_fetch_assoc($data);
}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data Entry Automation Software</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <div class="center">
    <form action="#" method="POST">
        <h1>Employee Data Entry Automation Software</h1>
        <div class="form">
            <input type="text" name="search" class="textfield" placeholder="Search Id"
value ="<?php if(isset($_POST['searchdata'])){ echo $result['id'];}?>">
            <input type="text" name="name" class="textfield" placeholder="Employee Name"
value ="<?php if(isset($_POST['searchdata'])){ echo$result['emp_name'];}?>">
            <select class="textfield" name="gender">
                <option value ="not selected">Select Gender</option>
                <option value ="Male"
                <?php if (isset($result['emp_gender']) && $result['emp_gender'] == 'Male') echo 'selected'; ?>
                >Male</option>
                <option value ="female" <?php if (isset($result['emp_gender']) && $result['emp_gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value ="other"<?php if (isset($result['emp_gender']) && $result['emp_gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            <input type="text" name="email" class="textfield" placeholder="Email Address" value = "<?php if (isset($result['emp_email'])) echo htmlspecialchars($result['emp_email']); ?>">
            <select class="textfield" name="department">
                <option value ="not selected">Select Department</option>
                <option value ="IT"<?php if (isset($result['emp_department']) && $result['emp_department'] == 'IT') echo 'selected'; ?>>IT</option>
                <option value ="HR"<?php if (isset($result['emp_department']) && $result['emp_department'] == 'HR') echo 'selected'; ?>>HR</option>
                <option value ="accounts"<?php if (isset($result['emp_department']) && $result['emp_department'] == 'Accounts') echo 'selected'; ?>>Accounts</option>
                <option value ="marketing"<?php if (isset($result['emp_department']) && $result['emp_department'] == 'Marketing') echo 'selected'; ?>>Marketing</option>
                <option value ="business development"<?php if (isset($result['emp_department']) && $result['emp_department'] == 'Business Development') echo 'selected'; ?>>Business Development</option>
            </select>
            <textarea placeholder="Address" name="address"><?php if (isset($result['emp_address'])) echo htmlspecialchars($result['emp_address']); ?></textarea>
            <input type="submit" value="Search" name="searchdata" class="btn">
            <input type="submit" value="Save" name="save" class="btn" style="background-color: green;">
            <input type="submit" value="Update" name="update" class="btn" style="background-color: orange;">
            <input type="submit" value="Delete" name="delete" class="btn" style="background-color: red;" onclick="checkdelete()">
            <input type="button" value="Clear" name="clear" class="btn" style="background-color: blue;" onclick="clearForm();">
        </div> 
    </form>
</div>
</body>
</html>
<script>
    function checkdelete(){
   return  confirm ('Are you want to delete this')  ;
    }
    function clearForm() {
            document.querySelector('.center form').reset();
            var fields = document.querySelectorAll('.textfield, textarea');
            fields.forEach(field => field.value = ''); }
</script>
<?php
if (isset($_POST['save'])) {
    $emp_name = $_POST['name'];
    $emp_gender = $_POST['gender'];
    $emp_email = $_POST['email'];
    $emp_department = $_POST['department'];
    $emp_address = $_POST['address'];

    $query = "INSERT INTO FORM (emp_name, emp_gender, emp_email, emp_department, emp_address) VALUES ('$emp_name', '$emp_gender', '$emp_email', '$emp_department', '$emp_address')";

    $data = mysqli_query($conn, $query);
    if ($data) {
        echo "<script>  alert (' Data saved into Database')  </script>";
    } else {
        echo " <script> alert ('Failed to save data') </script>";
    }
}
?>

<?php
if(isset($_POST['delete']))
{
    $id = $_POST['search'];
    $query = "DELETE FROM FORM WHERE id = '$id'";
    $data = mysqli_query($conn , $query);
    if($data)
    {
        echo " <script> alert ('Record is deleted') </script>";
    }
    else {
        echo " <script> alert ('Record is not deleted') </script>";
    }
}
?>
<?php 

if (isset($_POST['update'])) {
    $id = $_POST['search'];
    $emp_name = $_POST['name'];
    $emp_gender = $_POST['gender'];
    $emp_email = $_POST['email'];
    $emp_department = $_POST['department'];
    $emp_address = $_POST['address'];

    $query = "UPDATE FORM SET emp_name = '$emp_name', emp_gender = '$emp_gender', emp_email = '$emp_email', emp_department = '$emp_department', emp_address = '$emp_address' WHERE id = '$id'";
    $data = mysqli_query($conn, $query);
    if ($data) {
        echo "<script>alert('Record is updated');</script>";
    } else {
        echo "<script>alert('Record is not updated');</script>";
    }
}
?>
