<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a href="<?php echo base_url(); ?>">
        <img class="navbar-brand img-fluid site-logo" width="150" src="<?php echo base_url().$this->settings["logo"]; ?>" alt="<?php echo $this->settings["company"]; ?>" title="<?php echo $this->settings["company"]; ?>">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php $this->load->view("nodcms-navbar"); ?>
    </ul>

    <ul class="navbar-nav ml-auto">
        <?php if($this->userdata != null ){ ?>
            <li class="nav-item dropdown dropdown-user">
                <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="<?php echo $this->userdata['username']; ?>" class="rounded-circle user-avatar-img" src="<?php echo get_user_avatar_url($this->userdata); ?>"/>
                    <span class="hidden-xs"> <?php echo $this->userdata['username']; ?> </span>
                </a>
                <div class="dropdown-menu">
                    <?php if($this->userdata['has_dashboard']){ ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>user/dashboard"><i class="icon-speedometer"></i> <?php echo _l('Dashboard',$this);?></a>
                    <?php } ?>
                    <?php if(in_array($this->userdata['group_id'],array(1,100))){ ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin"><i class="icon-grid"></i> <?php echo _l('Control Panel',$this);?> </a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/settings"><i class="icon-settings"></i> <?=_l('Settings',$this);?></a>
                    <?php } ?>
                    <a class="dropdown-item" href="<?php echo base_url()."user/account"; ?>"><i class="icon-user"></i> <?=_l('Account Setting',$this);?></a>
                    <a class="dropdown-item" href="<?php echo base_url()."logout"; ?>"><i class="icon-power"></i> <?=_l('Log Out',$this);?></a>
                </div>
            </li>
        <?php }else{ ?>
            <li class="nav-item dropdown dropdown-user">
                <a href="javascript:;" class="nav-link" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <?php echo _l("Account", $this); ?>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url().$this->language['code']; ?>/login">
                        <i class="icon-lock-open"></i>
                        <?php echo _l("Login",$this); ?>
                    </a>
                    <?php if($this->settings['registration']==1){ ?>
                        <a class="dropdown-item" href="<?php echo base_url().$this->language['code']; ?>/user-registration">
                            <i class="icon-user-follow"></i>
                            <?php echo _l("Register",$this); ?>
                        </a>
                    <?php } ?>
                </div>
            </li>
        <?php } ?>
        <?php if(isset($languages) && count($languages)>1){ ?>
        <li class="nav-item dropdown dropdown-language">
            <a href="javascript:;" class="nav-link" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <i class="fas fa-globe-asia"></i>
                <?php echo $this->language['language_title']; ?>
            </a>
            <div class="dropdown-menu">
                <?php foreach($languages as $item) {?>
                    <?php if($item["language_id"]!=$_SESSION["language"]["language_id"]){ ?>
                        <a class="dropdown-item" href="<?php echo isset($item["lang_url"])?$item["lang_url"]:"javascript:;"; ?>">
                            <?php echo $item['language_title']; ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </li>
    <?php } ?>
    </ul>
    
  </div>
</nav>