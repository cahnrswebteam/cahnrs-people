<?php namespace cahnrswp\cahnrs\people;?>
<div id="people-editor">
	<h3>Position Info</h3>
    <div id="people-bio">
    	<?php wp_nonce_field('submit_person','people_nonce'); ?>
		<label>Position Title: </label><input type="text" name="_title" value="<?php echo $this->person->title;?>" /><br />
    </div>
	<h3>Contact Info</h3>
    <div id="people-contact-info">
    	<label>Email: </label><input type="text" name="_email" value="<?php echo $this->person->email;?>" /><br />
        <label>Phone: </label><input type="text" name="_phone" value="<?php echo $this->person->phone;?>" /><br />
        <label>Office: </label><input type="text" name="_office" value="<?php echo $this->person->office;?>" /><br />
        <label>Address: </label><input type="text" name="_address" value="<?php echo $this->person->address;?>" /><br />
    </div>
    <h3>Academic History</h3>
    <div id="people-academic-history">
    	<label>Graduate Degree: </label><input type="text" name="_graduate" value="<?php echo $this->person->graduate;?>" /><br />
        <label>Undergraduate Degree: </label><input type="text" name="_undergraduate" value="<?php echo $this->person->undergraduate;?>" /><br />
    </div>
    <h3>Profesional History</h3>
    <div id="people-professional-history">
    	<label>Curriculum Vitae: </label><input type="text" name="_cv" value="<?php echo $this->person->cv;?>" /><br />
    </div>
    <h3>Biographical Info</h3>
    <div id="people-bio">
		<?php wp_editor( $this->person->biography , 'content' );?>
    </div>
</div>