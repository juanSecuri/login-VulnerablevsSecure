package starter.chrome;

import net.serenitybdd.core.pages.PageObject;
import net.serenitybdd.core.pages.WebElementFacade;
import org.openqa.selenium.WebDriver;

import java.time.Duration;

public class LoginActions {
    private final PageObject page;

    public LoginActions(WebDriver driver) {
        this.page = new PageObject(driver) {};
    }

    /**
     * Inicia sesión con credenciales válidas.
     */
    public void withCredentials(String usuario, String password) {
        WebElementFacade userField = page.$("[name='usuario']");
        WebElementFacade passField = page.$("[name='password']");
        WebElementFacade submitBtn = page.$(".btn");

        // Espera y llena los campos
        userField.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        userField.sendKeys(usuario);

        passField.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        passField.sendKeys(password);

        // Clic en el botón login
        submitBtn.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilEnabled().click();
    }

    /**
     * Prueba de inyección SQL en el login.
     */
    public void attemptSqlInjection(String payload) {
        WebElementFacade userField = page.$("[name='usuario']");
        WebElementFacade passField = page.$("[name='password']");
        WebElementFacade submitBtn = page.$(".btn");

        userField.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        userField.sendKeys(payload);

        passField.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        passField.sendKeys("x");

        submitBtn.withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilEnabled().click();
    }
}
