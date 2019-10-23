
<div class="form middle content ">
    <div class="text-center">
    <a class="btn btn-primary active text-white">Login</a> || <a><a href="/auth/signup" class="btn btn-secondary">Sign Up</a></a></div>
<?php
echo $this->Form->create();
echo $this->Form->input('email',['type'=>'email','required','name'=>'username']);
echo $this->Form->input('password',['type'=>'password','required']);
echo $this->Form->button('Log In',['class'=>'btn btn-primary text-center']);
echo $this->Form->end();
?>
</div>
