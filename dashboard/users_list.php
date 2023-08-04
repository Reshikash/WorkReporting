<?php 

  include "header.php";
  if($role != 0){
    header("location: ../404.php");
  }
  $sql = "SELECT * FROM `user_table`";
  $query = mysqli_query($con, $sql);
  $rows = mysqli_num_rows($query);
?>
<div class="container mt-2 table-responsive px-5 py-2 bg-white border border-secondary">
  <h4 class="text-center mb-3">Employee List</h4> <a href="add_emp.php" class="btn btn-primary">Add New</a>
  <hr>
  <table class="table table-hover bg-white table-sm">
    <thead>
      <tr>
        <th>Sr.#</th>
        <th>Employee Name</th>
        <th>Designation</th>
        <th>Scale</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 

        if($rows){
          $count = 0;
          foreach( $query as $row){
      ?>
      <tr>
        <td><?= ++$count ?></td>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['user_des'] ?></td>
        <td><?= $row['user_scale'] ?></td>
        <td class="d-flex"> 
          <span><a href="profile.php?id=<?= $row['id'] ?>"><i class="bi bi-eye-fill text-success mx-1"></i></a></span> 
          <span><a href="edit_emp.php?id=<?= $row['id'] ?>"><i class="bi bi-pencil-square text-primary mx-1"></i></a></span>
          <form action="" method="POST">
            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
            <button class="p-0 border-0 bg-light" name="User_delete"><i class="bi bi-trash3-fill text-danger mx-1"></i></button>
          </form>
        </td>
      </tr>
      <?php 
      
          }
        }else{
          echo "<tr><td colspan='5'>No Record Found</td></tr>";
        } 
      
      ?>
</div>
</tbody>
</table>
</div>
<?php 

  include "footer.php";
  if(isset($_POST['User_delete'])){
    $emp_id = $_POST['user_id'];
    $sql2 = "DELETE FROM `user_table` WHERE id = '$emp_id'";
    $query2 = mysqli_query($con, $sql2);
    if($query2){
      header('location: users_list.php');
    }else{
      echo "Delete Successfull";
    }
  }

?>