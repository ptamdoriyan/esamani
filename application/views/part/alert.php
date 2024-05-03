<?php if ($this->session->flashdata('success')): ?>
	<div
		class="alert alert-success mb-2"
		role="alert"
		id="flash_message"
	>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		<?= $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div
		class="alert alert-danger mb-2"
		role="alert"
		id="flash_message"
	>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		<?= $this->session->flashdata('error'); ?>
	</div>
<?php endif;?>

<?php if ($this->session->flashdata('warning')): ?>
	<div
		class="alert alert-warning mb-2"
		role="alert"
		id="flash_message"
	>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		<?= $this->session->flashdata('warning'); ?>
	</div>
<?php endif; ?>
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>