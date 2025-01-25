<!-- Header -->
<div class="header header-one" style="background-color: #0D969C;">
         <a href="javascript:void(0);" id="toggle_btn">
            <span class="toggle-bars">
               <span class="bar-icons"></span>
               <span class="bar-icons"></span>
               <span class="bar-icons"></span>
               <span class="bar-icons"></span>
            </span>
         </a>

         <ul class="nav nav-tabs user-menu">
            <li class="nav-item dropdown">
               <a href="javascript:void(0)" class="user-link nav-link" data-bs-toggle="dropdown">
			   <span class="user-img">
               <?php if (!empty($this->session->userdata('foto'))): ?>
					   <img src="<?= base_url('assets/img/user/' . $this->session->userdata('foto')); ?>" alt="img" class="profilesidebar">
               <?php else: ?>
                  <img src="<?= base_url('assets/img/user/default.jpg'); ?>" alt="img" class="profilesidebar">
               <?php endif; ?>
					<span class="animate-circle"></span>
				</span>
                  <span class="user-content">
                     <span class="user-details"><?= $this->session->userdata('level'); ?></span>
                     <span class="user-name"><?= $this->session->userdata('nm_pengguna'); ?></span>
                  </span>
               </a>
               <div class="dropdown-menu menu-drop-user">
                  <div class="subscription-updateprofile">
                     <ul>
                        <li>
                           <a class="dropdown-item" href="<?= base_url('profile'); ?>">Profile</a>
                        </li>
                     </ul>
                  </div>
                  <div class="subscription-logout">
                     <ul>
                        <li>
                           <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Log Out</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </li>
         </ul>
      </div>
      <!-- /Header -->