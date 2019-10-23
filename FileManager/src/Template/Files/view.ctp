<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
$filePath=WWW_ROOT.DS.'upload/files/'.$file->name;
?>

    <?php if ($type==1):?>
        <?= $myfile = fopen($filePath, "r") or die("Unable to open file!")?>
        <?= fread($myfile,filesize($filePath))?>
        <?php fclose($myfile);?>
    <?php elseif ($type==2):?>
        <?php echo $this->Html->image('/upload/files/'.$file->name);?>
    <?php elseif ($type==3): ?>
        <?php
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline,filename="'.$filePath.'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($filePath);

            ?>
    <?php endif?>
