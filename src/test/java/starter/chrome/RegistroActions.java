package starter.chrome;

import net.serenitybdd.core.steps.UIInteractions;
import java.time.Duration;

public class RegistroActions extends UIInteractions {

    public void withData(String usuario, String password) {

        // Campos del formulario (por name)
        $("[name='usuario']").withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        $("[name='usuario']").sendKeys(usuario);

        $("[name='password']").withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        $("[name='password']").sendKeys(password);

        // Campo de confirmación de contraseña (usa el mismo password)
        $("[name='password2']").withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilVisible().clear();
        $("[name='password2']").sendKeys(password);

        // Clic en el botón de registro
        $(".btn").withTimeoutOf(Duration.ofSeconds(15))
                .waitUntilEnabled().click();
    }
}
