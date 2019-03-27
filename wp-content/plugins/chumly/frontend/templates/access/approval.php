<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 28/11/18
 * Time: 11:19 PM
 */ ?>

<?php do_action( 'chumly_before_content' ); ?>

<?php if($chumly_user->admin_approval){ ?>

<?php echo 'Account Awaiting Approval'; ?>

<?php } ?>

<?php do_action( 'chumly_after_content' ); ?>

