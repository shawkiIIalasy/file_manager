<h2>Login</h2> || <h2><a href="/auth/signup">Sign Up</a></h2>
<?php
echo $this->Form->create();
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->button('Submit');
echo $this->Form->end();
?>
