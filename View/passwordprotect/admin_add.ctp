<div class="passwordprotect form">
    <h2><?php echo $title_for_layout; ?></h2>
    
    <?php
      if(!is_writable($htpasswd)) { echo '<p class="error">'.__('Htpasswd is not writable',true).' ('.$htpasswd.')</p>'; }
    ?>
    
    <?php echo $this->Form->create('Htpasswd',array('url'=>$this->here));?>
    <fieldset>
        <div class="tabs">
            <ul>
                <li><a href="#passwordprotect-main"><span><?php __('User'); ?></span></a></li>
            </ul>

            <div id="region-main">
            <?php
                echo $this->Form->input('username',array('value'=>'','label'=>'Username'));
                echo $this->Form->input('password',array('type'=>'password','value'=>'','label'=>'Password'));
            ?>
            </div>
        </div>
    </fieldset>

    <div class="buttons">
    <?php
        echo $this->Form->end(__('Save', true));
        echo $this->Html->link(__('Cancel', true), array(
            'action' => 'index',
        ), array(
            'class' => 'cancel',
        ));
    ?>
    </div>
</div>