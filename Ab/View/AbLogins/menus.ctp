<?php $data = ( urlencode( json_encode( $data ) ) );?>
<form class="form-autosubmit" action="<?php echo $sistema_url;?>" method="post">
<input type="hidden" name="data[json]" value="<?php echo $data;?>">
</form>
