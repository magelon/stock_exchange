<?php
//this script is the body of post messages

echo "
<div class=\"row\">
<h2 class=\"col-md-4\">{$messages['subject']}</h2>\n
  <h3 class=\"col-md-8\">

  value:  {$messages['value']}   value_each:
  </h3>
<br />
</div>
<div class=\"row\">
  <div class=\"col-md-4\">{$messages['body_t']}
  </div>

</div>

";
?>
<?php
if (isset($_SESSION['user_id'])) {
echo "
<div class=\"row\">

<!--buy button -->
  <div class=\"col-md-1\">
  <!-- Trigger the modal with a button -->
<button type=\"button\" class=\"btn btn-info btn-xs\" data-toggle=\"modal\" data-target=\"#myModal\">funde</button>

<!-- Modal -->
<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">

    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Modal Header</h4>
      </div>
      <div class=\"modal-body\">
        <p>Some text in the modal.</p>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
      </div>
    </div>

  </div>
</div>

  </div>

  <!--sell button -->
  <div class=\"col-md-1\">
  <!-- Trigger the modal with a button -->
<button type=\"button\" class=\"btn btn-info btn-xs\" data-toggle=\"modal\" data-target=\"#myModal\">sell</button>

<!-- Modal -->
<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">

    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Modal Header</h4>
      </div>
      <div class=\"modal-body\">
        <p>Some text in the modal.</p>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
      </div>
    </div>

  </div>
</div>

  </div>
</div>
 ";
}
  ?>
