<?php $this->load->helper('html');?>
<?=doctype();?>

<html lang="ru">
<head>
<?php $this->load->view($_path['head'], $_head);?>
</head>

<body>
<?php $this->load->view($_path['body']);?>
</body>
</html>