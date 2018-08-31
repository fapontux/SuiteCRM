<?php
/**
 * Class UserWizardCest
 * As an administrative user, I want to use the install wizard (web based) to install SuiteCRM.
 */
class UserWizardCest
{

    /**
     * @param InstallTester $I
     */
    public function _before(InstallTester $I)
    {
    }

    /**
     * @param InstallTester $I
     */
    public function _after(InstallTester $I)
    {
    }

    /**
     * @param \Helper\WebDriverHelper $webDriverHelper
     * Dependency injection
     */
    protected function _inject(\Helper\WebDriverHelper $webDriverHelper)
    {
        $this->webDriverHelper = $webDriverHelper;
    }

    // tests
    /**
     * @param InstallTester $I
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As an administrative user, I want to use the install wizard (web based) to install SuiteCRM.
     * Given that that I install SuiteCRM with the default configuration settings I
     * Expect to be able to login as an administrator.
     */
    public function testScenarioInstallSuiteCRMWithDefaultConfiguration(InstallTester $I, \Helper\WebDriverHelper $webDriverHelper)
    {
        $I->wantTo('check the php version meets the recommended requirements.');
        $I->amOnUrl($webDriverHelper->getInstanceURL());
        $I->waitForText('Setup');
        $I->maySeeOldVersionDetected();
        $I->acceptLicense();
        $I->seeValidSystemEnvironment();
        $I->configureInstaller($webDriverHelper);
        $I->waitForInstallerToFinish();
        
        // ---------- Email Settings ---------------
        
        $I->wantTo('Save an outgoing email configuration');
        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );
         // Navigate to email configuration and save settings
        $I->loginAsAdmin();
        $emailMan->createEmailSettings();
         $I->dontSee('Note: To send record assignment notifications, an SMTP server must be configured in Email Settings.');
    }

}
