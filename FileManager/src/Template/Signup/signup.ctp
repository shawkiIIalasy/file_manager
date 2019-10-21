<h2>Sign Up</h2> || <h2><a href="/auth/login">Log In</a></h2>

<?php
echo $this->Form->create('',array('url'=>'/auth/add'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->button('Submit');
echo $this->Form->end();
?>
