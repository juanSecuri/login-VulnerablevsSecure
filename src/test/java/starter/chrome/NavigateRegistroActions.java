package starter.chrome;

import net.serenitybdd.core.steps.UIInteractions;

public class NavigateRegistroActions extends UIInteractions {

    public void toRegistroPage() {
        String base = System.getProperty("webdriver.base.url");
        if (base == null || base.trim().isEmpty()) {
            base = System.getenv("WEBDRIVER_BASE_URL");
        }
        if (base == null || base.trim().isEmpty()) {
            base = "http://localhost/repositorioFormTesting/src/webapp/vulnerable";
        }
        if (base.endsWith("/")) {
            base = base.substring(0, base.length() - 1);
        }
        openUrl(base + "/registrate.php");
    }
}
