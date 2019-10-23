
<div class="form middle content ">
    <div class="text-center">
        <a><a href="/auth/login" class="btn btn-secondary">Login</a></a> || <a class="btn btn-primary active text-white">Sign Up</a></div>
    <?php
    echo $this->Form->create('',array('url'=>'/auth/add'));
    echo $this->Form->input('username',['type'=>'email','required']);
    echo $this->Form->input('password',['type'=>'password','required']);
    echo $this->Form->input('confirm_password',['type'=>'password','name'=>'cPassword','required']);
    echo $this->Form->button('Sign Up',['class'=>'btn btn-primary text-center']);
    echo $this->Form->end();
    ?>
</div>
