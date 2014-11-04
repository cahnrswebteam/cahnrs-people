
<div class="profile-content">
	<?php if( has_post_thumbnail() ):?>
    <div class="profile-image">
         <?php the_post_thumbnail( 'medium' ); ?>
    </div>
    <?php endif;?>
    <div class="profile-title<?php if( has_post_thumbnail() ) echo ' has-image';?>">
    <h2><?php the_title();?></h2>
    <h3><?php echo $this->person->title;?></h3>
    Email: <a href="mailto:<?php echo $this->person->email;?>" ><?php echo $this->person->email;?></a><br />
    Phone: <?php echo $this->person->phone;?><br />
    Office: <?php echo $this->person->office;?><br />
    </div>
    <div class="profile-bio ">
    <?php echo $this->person->biography;?>
    </div>
</div><div class="profile-content-right">
	<?php if( $this->person->cv ) echo '<h5><a href="'.$this->person->cv.'">Curriculum Vitae</a></h5>';?>
    <h5>Education</h5>
    <?php if( $this->person->graduate ):?>
    <p>
        <?php echo $this->person->graduate;?>
    </p>
    <?php endif;?>
    <?php if( $this->person->undergraduate ):?>
    <p>
        <?php echo $this->person->undergraduate;?>
    </p>
    <?php endif;?>
    
    <h5>Physical Mail</h5>
    <?php echo $this->person->address;?>
</div>
