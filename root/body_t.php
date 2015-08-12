<?php
echo "
<div class=\"row\">
<h2 class=\"col-md-4\">{$messages['subject']}</h2>\n
  <h3 class=\"col-md-8\">
  value:  {$messages['value']}   value_each:{$messages['value']}
  </h3>
<br />
</div>
<div class=\"row\">
  <div class=\"col-md-4\">{$messages['body_t']}
  </div>

</div>
<div class=\"row\">
  <div class=\"col-md-2\">
  <form>
    <button type=\"button\" class=\"btn btn-danger\">Buy</button>
    </div>
    </form>
</div>
";
?>
