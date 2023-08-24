<?php
    echo $this->include('\Modules\Master\Views\header');

?>   

    <?php echo $this->renderSection('content'); ?>

<?php
    echo $this->include('\Modules\Master\Views\footer');
?> 
