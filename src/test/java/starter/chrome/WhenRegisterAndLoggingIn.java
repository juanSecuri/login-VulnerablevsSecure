package starter.chrome;

import net.serenitybdd.core.Serenity;
import net.serenitybdd.junit5.SerenityJUnit5Extension;
import net.serenitybdd.annotations.Managed;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.openqa.selenium.WebDriver;

import static org.assertj.core.api.Assertions.assertThat;

@ExtendWith(SerenityJUnit5Extension.class)
public class WhenRegisterAndLoggingIn {

    @Managed
    WebDriver driver;

    NavigateRegistroActions navigateRegistro;
    RegistroActions registro;
    NavigateLoginActions navigateLogin;
    LoginActions login;

    @BeforeEach
    public void setUp() {
        navigateRegistro = new NavigateRegistroActions();
        registro = new RegistroActions();
        navigateLogin = new NavigateLoginActions(driver);
        login = new LoginActions(driver);

        // Inyectamos manualmente el driver de Serenity
        navigateRegistro.setDriver(driver);
        registro.setDriver(driver);

    }

    @Test
    void userShouldRegisterAndSeeContenidoPage() {
        String usuario = "contatame" + System.currentTimeMillis();
        String password = "L1234566*";

        navigateRegistro.toRegistroPage();
        registro.withData(usuario, password);

        navigateLogin.toLoginPage();
        login.withCredentials(usuario, password);

        Serenity.reportThat("El usuario debería ver contenido.php",
                () -> assertThat(waitForContenido(10000)).isTrue()
        );
    }

    @Test
    void sqlInjectionBehaviorDependsOnEnvironment() {
        String payload = "' or 1=1--";
        navigateLogin.toLoginPage();
        login.attemptSqlInjection(payload);

        boolean hasContenido = waitForContenido(4000);

        String expectSqliProp = System.getProperty("expect.sqli");
        if (expectSqliProp == null) {
            expectSqliProp = System.getenv("EXPECT_SQLI");
        }
        boolean expectSqli = Boolean.parseBoolean(expectSqliProp != null ? expectSqliProp : "false");

        if (expectSqli) {
            Serenity.reportThat("En entorno vulnerable, la inyección debería permitir acceso",
                    () -> assertThat(hasContenido).isTrue());
        } else {
            Serenity.reportThat("En entorno seguro, la inyección NO debería permitir acceso",
                    () -> assertThat(hasContenido).isFalse());
        }
    }

    private boolean waitForContenido(long timeoutMs) {
        long end = System.currentTimeMillis() + timeoutMs;
        while (System.currentTimeMillis() < end) {
            String currentUrl = driver.getCurrentUrl();
            System.out.println("🌐 URL actual: " + currentUrl);
            if (currentUrl.contains("contenido.php")) return true;
            try {
                Thread.sleep(300);
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
            }
        }
        return false;
    }
}
