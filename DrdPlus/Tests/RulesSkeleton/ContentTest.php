<?php
declare(strict_types=1);
/** be strict for parameter types, https://www.quora.com/Are-strict_types-in-PHP-7-not-a-bad-idea */

namespace DrdPlus\Tests\RulesSkeleton;

class ContentTest extends \DrdPlus\Tests\FrontendSkeleton\ContentTest
{
    use AbstractContentTestTrait;

    /**
     * @test
     */
    public function Authors_got_heading(): void
    {
        $authorsHeading = $this->getHtmlDocument()->getElementById('autori');
        if (!$this->getTestsConfiguration()->hasAuthors()) {
            self::assertEmpty($authorsHeading, 'Authors are not expected');

            return;
        }
        self::assertNotEmpty($authorsHeading, 'Authors should have heading (h3)');
        self::assertSame(
            'h3',
            $authorsHeading->nodeName,
            'Authors heading should be h3, but is ' . $authorsHeading->nodeName
        );
    }

    /**
     * @test
     */
    public function Page_has_title(): void
    {
        parent::Page_has_title();
        $rulesTitle = $this->getCurrentPageTitle($this->getHtmlDocument());
        $passTitle = $this->getCurrentPageTitle($this->getPassDocument());
        self::assertNotEmpty($rulesTitle, 'Rules title is missing');
        self::assertNotEmpty($passTitle, 'Pass title is missing');
        self::assertSame($rulesTitle, $passTitle, 'Rules and pass titles should be the same');
    }

}