
<div class="form middle content ">
    <div class="text-center">
        <a><a href="/auth/login">Login</a></a> || <a class="label">Sign Up</a></div>
    <?php
    echo $this->Form->create('',array('url'=>'/auth/add'));
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->input('confirm_password');
    echo $this->Form->button('Submit');
    echo $this->Form->end();
    ?>
</div>
