package starter.chrome;

import net.serenitybdd.core.pages.PageObject;
import org.openqa.selenium.WebDriver;

public class NavigateLoginActions {
    private PageObject page;

    public NavigateLoginActions(WebDriver driver) {
        this.page = new PageObject(driver) {};
    }

    public void toLoginPage() {
        String base = System.getProperty("webdriver.base.url");
        if (base == null || base.trim().isEmpty()) {
            base = System.getenv("WEBDRIVER_BASE_URL");
        }
        if (base == null || base.trim().isEmpty()) {
            base = "http://localhost/repositorioFormTesting/src/webapp/vulnerable";
        }
        if (base.endsWith("/")) base = base.substring(0, base.length()-1);
        page.openUrl(base + "/login.php");
    }
}
