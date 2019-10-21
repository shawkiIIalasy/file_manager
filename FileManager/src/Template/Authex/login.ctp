
<div class="form middle content ">
    <div class="text-center">
    <a class="label">Login</a> || <a><a href="/auth/signup">Sign Up</a></a></div>
<?php
echo $this->Form->create();
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->button('Submit');
echo $this->Form->end();
?>
</div>
