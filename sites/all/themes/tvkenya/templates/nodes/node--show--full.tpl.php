<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <header>
    <?php if ($channel): ?>
    <div class="channel">
      <?php print $channel; ?>
    </div>
    <?php endif; ?>

    <div class="wrapper-basic-info">
      <h1 class="title">
        <?php print $title; ?>
      </h1>
      <?php if ($start_end_datetime): ?>
      <span class="start-end-datetime">
        <?php print $start_end_datetime; ?>
      </span>
      <?php endif; ?>
    </div>
  </header>

  <div class="outer-wrapper-details">
    <div class="wrapper-details <?php $image ? "with-image" : "without-image"; ?>">
      <div class="inner-wrapper-details">
        <?php if ($image): ?>
        <div class="wrapper-image">
          <?php print $image; ?>
        </div>
        <?php endif; ?>

        <div class="outer-wrapper-description">
          <?php if (isset($description)): ?>
          <div class="wrapper-description">
            <?php print $description; ?>
          </div>
          <?php endif; ?>
          <?php if (isset($social_links)): ?>
          <div class="social">
            <?php print $social_links; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="wrapper-comments">
        <?php print $comments; ?>
      </div>
    </div>
    <?php if (isset($ad)): ?>
    <div class="ad">
      <?php print $ad; ?>
    </div>
    <?php endif; ?>
  </div>

  <footer class="navigation">
    <?php if (isset($navigation)): ?>
      <?php print $navigation; ?>
    <?php endif; ?>
  </footer>
</article>