<?php declare(strict_types=1);
/** @var $configuration \DrdPlus\RulesSkeleton\Configurations\Configuration */
$menuConfiguration = $configuration->getMenuConfiguration();
$fixed = $menuConfiguration->isPositionFixed()
    ? 'fixed'
    : '';
$homeButton = '';
/** @var $homepageDetector \DrdPlus\RulesSkeleton\HomepageDetector */
if (($menuConfiguration->isShowHomeButtonOnHomepage() && $homepageDetector->isHomepageRequested())
    || ($menuConfiguration->isShowHomeButtonOnRoutes() && !$homepageDetector->isHomepageRequested())
) {
    $homeButtonId = \DrdPlus\RulesSkeleton\HtmlHelper::ID_HOME_BUTTON;
    $homeButton = <<<HTML
<span class="menu">
    <a id="{$homeButtonId}" class="internal-url" href="{$menuConfiguration->getHomeButtonTarget()}">
        <img class="home" alt="Small dragon menu" src="/images/generic/skeleton/drdplus-dragon-menu-2x22.png">
    </a>
</span>
HTML;
}
?>

<div class="contacts visible top permanent <?= $fixed ?>" id="menu">
  <div class="container">
      <?= $homeButton ?>
    <span class="contact">
      <a href="mailto:info@drdplus.info">
        <span class="small-screen"><i class="fas fa-envelope"></i></span>
        <span class="wide-screen"><i class="fas fa-envelope"></i> info@drdplus.info</span>
      </a>
    </span>
    <span class="contact">
      <a target="_blank" class="rpgforum-contact" href="https://rpgforum.cz/forum/viewtopic.php?f=238&t=14870">
        <span class="small-screen"><i class="fas fa-dice-six"></i></span>
        <span class="wide-screen"><i class="fas fa-dice-six"></i> RPG fórum</span>
      </a>
    </span>
    <span class="contact">
      <a target="_blank" class="discord-contact" href="https://discord.com/invite/FVz5V3Q">
        <span class="small-screen"><i class="fab fa-discord"></i></span>
        <span class="wide-screen"><i class="fab fa-discord"></i> Discord</span>
      </a>
    </span>
    <span class="contact">
      <a target="_blank" class="twitter-contact" href="https://twitter.com/DrdInfo">
        <span class="small-screen"><i class="fab fa-twitter-square"></i></span>
        <span class="wide-screen"><i class="fab fa-twitter-square"></i> Twitter</span>
      </a>
    </span>
    <span class="contact">
      <a target="_blank" class="facebook-contact" href="https://www.facebook.com/drdplus.info">
        <span class="small-screen"><i class="fab fa-facebook-square"></i></span>
        <span class="wide-screen"><i class="fab fa-facebook-square"></i> Facebook</span>
      </a>
    </span>
    <span class="contact">
      <a target="_blank" class="trello-contact" href="https://trello.com/b/L64FNYj3/drdplusinfo">
        <span class="small-screen"><i class="fab fa-trello"></i></span>
        <span class="wide-screen"><i class="fab fa-trello"></i> Trello</span>
      </a>
    </span>
  </div>
</div>
<div class="contacts-placeholder invisible">
  Placeholder for contacts
</div>
