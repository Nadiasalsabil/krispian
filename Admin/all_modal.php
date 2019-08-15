<!-- EDIT Data Set -->
<div class="modal fade" id="edit_dataset<?php echo $data['id_dataset']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Data Training</h4>
      </div>
      <div class="modal-body">
     
      <form action="/action_page.php">
      <input type="hidden" class="form-control" name="id_dataset" value="<?= $data['id_dataset'] ?>">
      <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea class="form-control" rows="5" name="tweet"><?php echo $data['tweet'] ?></textarea>
    </div>




        </form>



      </div>
      
    </div>

  </div>
</div>