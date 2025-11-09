package starter.chrome;

import net.serenitybdd.core.pages.PageObject;

public class ContenidoPage extends PageObject {

    /**
     * Espera (polling sencillo) hasta 5 segundos para comprobar que la URL contiene "contenido.php".
     * Devuelve true si la URL es la esperada.
     */
    public boolean isAtContenidoPage() {
        int attempts = 10;
        try {
            for (int i = 0; i < attempts; i++) {
                if (getDriver().getCurrentUrl().contains("contenido.php")) {
                    return true;
                }
                Thread.sleep(500);
            }
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
        }
        return getDriver().getCurrentUrl().contains("contenido.php");
    }
}
