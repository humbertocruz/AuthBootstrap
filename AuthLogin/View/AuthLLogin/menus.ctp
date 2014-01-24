<?php $data = ( urlencode( json_encode( $data ) ) ); ?>
<form class="form-autosubmit" action="https://login.vagr.com/authenticate" method="post">
<input type="hidden" name="data[json]" value="<?php echo $data;?>">
</form>
