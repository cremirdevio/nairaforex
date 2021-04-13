<footer>
  <!-- footer content begin -->
  <div class="uk-section uk-section-muted uk-padding-large uk-padding-remove-horizontal uk-margin-medium-top">
    <div class="uk-container">
      <div class="uk-grid-medium" data-uk-grid>
        <div class="uk-width-expand@m">
          <img class="uk-margin-small-right in-margin-top-30@s" src="{{ asset('img/logo/nairaforex-1.png') }}" data-src="{{ asset('img/logo/nairaforex-1.png') }}"
            alt="wave" width="134" height="23" data-uk-img>
          <p class="uk-text-large uk-margin-small-top">Trade with freedom.</p>
          <p class="uk-visible@m">Imperium Tower (Headquarters)<br>
            Jl. Prof Dr Satrio, Kuningan<br>
            12920<br>
            Jakarta - xxxxxxxxxxxxxxx
          </p>
        </div>
        <div class="uk-width-3-5@m">
          <div class="uk-child-width-1-3@s uk-child-width-1-3@m" data-uk-grid>
            <div>
              <h4><span>Markets</span></h4>
              <ul class="uk-list uk-link-text">
                <li><a href="{{ route('traders') }}">Remote Traders</a></li>
                <li><a href="{{ route('static', 'partner-with-nairaforex') }}">Partner with Nairaforex</a></li>
              </ul>
            </div>
            <div>
              <h4><span>Resources</span></h4>
              <ul class="uk-list uk-link-text">
                <li><a href="{{ route('static', 'frequently-asked-questions') }}">Frequently Asked Questions</a></li>
                <li><a href="{{ route('register') }}">Create an Account</a></li>
              </ul>
            </div>
            <div>
              <h4><span>Company</span></h4>
              <ul class="uk-list uk-link-text">
                <li><a href="{{ route('static', 'terms-and-conditions') }}">Terms and Conditions </a></li>
                <li><a href="{{ route('static', 'privacy-policy') }}">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="uk-section uk-section-secondary uk-bg-primary uk-padding-remove-vertical">
    <div class="uk-container">
      <div class="uk-grid">
        <div class="uk-width-3-4@m uk-visible@m">
          <ul class="uk-subnav uk-subnav-divider">
            <li><a href="{{ route('static', 'terms-and-conditions') }}">Terms and Conditions </a></li>
            <li><a href="{{ route('static', 'privacy-policy') }}">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="uk-width-expand@m uk-text-right@m">
          <p>© 2021 Nairaforex Inc.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- footer content end -->
  <!-- module totop begin -->
  <div class="uk-visible@m">
    <a href="#" class="in-totop fas fa-chevron-up" data-uk-scroll></a>
  </div>
  <!-- module totop begin -->
</footer>