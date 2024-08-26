  <!-- header -->
  <header>
      <div class="navbar-fixed">
          <nav>
              <div class="nav-wrapper blue-grey darken-4">
                  <a id="logo" href="/" class="brand-logo">
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M11.7769 10L16.6065 11.2941" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                          <path d="M11 12.8975L13.8978 13.6739" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                          <path d="M20.3116 12.6473C19.7074 14.9024 19.4052 16.0299 18.7203 16.7612C18.1795 17.3386 17.4796 17.7427 16.7092 17.9223C16.6129 17.9448 16.5152 17.9621 16.415 17.9744C15.4999 18.0873 14.3834 17.7881 12.3508 17.2435C10.0957 16.6392 8.96815 16.3371 8.23687 15.6522C7.65945 15.1114 7.25537 14.4115 7.07573 13.641C6.84821 12.6652 7.15033 11.5377 7.75458 9.28263L8.27222 7.35077C8.35912 7.02646 8.43977 6.72546 8.51621 6.44561C8.97128 4.77957 9.27709 3.86298 9.86351 3.23687C10.4043 2.65945 11.1042 2.25537 11.8747 2.07573C12.8504 1.84821 13.978 2.15033 16.2331 2.75458C18.4881 3.35883 19.6157 3.66095 20.347 4.34587C20.9244 4.88668 21.3285 5.58657 21.5081 6.35703C21.669 7.04708 21.565 7.81304 21.2766 9" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                          <path d="M3.27222 16.647C3.87647 18.9021 4.17859 20.0296 4.86351 20.7609C5.40432 21.3383 6.10421 21.7424 6.87466 21.922C7.85044 22.1495 8.97798 21.8474 11.2331 21.2432C13.4881 20.6389 14.6157 20.3368 15.347 19.6519C15.8399 19.1902 16.2065 18.6126 16.415 17.9741M8.51621 6.44531C8.16368 6.53646 7.77741 6.63996 7.35077 6.75428C5.09569 7.35853 3.96815 7.66065 3.23687 8.34557C2.65945 8.88638 2.25537 9.58627 2.07573 10.3567C1.91482 11.0468 2.01883 11.8129 2.30728 13" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      <span class="logo-name">Sticky</span>
                  </a>
                  <a data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                  <ul class="right hide-on-med-and-down">
                      <?php if (isAuthenticated()) : ?>
                          <li><a href="/settings" class="<?= urlIs('/settings') ? 'cyan-text accent-3' : '' ?>">settings</a></li>
                          <li><a href="/logout" class="red-text">logout</a></li>
                      <?php else : ?>
                          <li><a href="/login" class="<?= urlIs('/login') ? 'cyan-text accent-3' : '' ?>">login</a></li>
                          <li><a href="/registration" class="<?= urlIs('/registration') ? 'cyan-text accent-3' : '' ?>">registration</a></li>
                      <?php endif; ?>
                  </ul>
              </div>
          </nav>

          <ul class="sidenav" id="mobile-demo">
              <?php if (isAuthenticated()) : ?>
                  <li><a href="/settings" class="<?= urlIs('/settings') ? 'cyan-text accent-3' : '' ?>">settings</a></li>
                  <li><a href="/logout" class="red-text">logout</a></li>
              <?php else : ?>
                  <li><a href="/login" class="<?= urlIs('/login') ? 'cyan-text accent-3' : '' ?>">login</a></li>
                  <li><a href="/registration" class="<?= urlIs('/registration') ? 'cyan-text accent-3' : '' ?>">registration</a></li>
              <?php endif; ?>
          </ul>
      </div>
  </header>
  <!--  -->