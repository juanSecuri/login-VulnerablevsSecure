# 🧠🔓 Login: Vulnerable vs Secure — Laboratorio Práctico (PHP + Serenity + Azure)

> 🧠 **Soy el tipo que rompe la puerta para después cerrarla con llave.**  
> Desarrollé un laboratorio completo que confronta **un login vulnerable a SQLi** con **su versión segura** — automatizado con Serenity BDD y orquestado desde un agente self-hosted en Azure DevOps.

---

## 🚀 ¿Qué es esto? (mini pitch)
Un repo didáctico y reproducible para mostrar, probar y explicar **qué hace una inyección SQL** y **cómo protegerse contra ella**.  
Ideal para entrevistas, demos, posts en LinkedIn y aprendizaje hands-on.

---

## 🔍 ¿Qué contiene?
- `src/webapp/vulnerable/` → demo intencionalmente vulnerable (concatenación SQL).  
- `src/webapp/secure/` → versión corregida (PDO con prepared statements y `password_hash`/`password_verify`).  
- Tests E2E con **Serenity (Java + Maven)**: registro, login normal y test de SQLi (`' or 1=1--`).  
- `azure-pipelines.yml` → pipeline orientado a agente self-hosted (ejecuta `mvn clean verify`).  
- `sql/schema.sql` → script para crear la DB de prueba.  
- `target/site/serenity/` → reportes generados por Serenity (HTML).

---

## ⚡ Demo rápido (comandos esenciales)
1. Levanta XAMPP / MySQL y coloca el proyecto en `htdocs`.  
2. Importa DB:
```bash
mysql -u root -p < sql/schema.sql

Ajusta config.php (credenciales DB).

Ejecuta los tests contra la versión vulnerable:
mvn clean verify "-Dwebdriver.base.url=http://localhost/repositorioFormTesting/src/webapp/vulnerable" -Dexpect.sqli=true

Contra la versión segura:
mvn clean verify "-Dwebdriver.base.url=http://localhost/repositorioFormTesting/src/webapp/secure" -Dexpect.sqli=false

✅ Resultados esperados (simple)

Registro y login normal → ✅

SQLi en /vulnerable con -Dexpect.sqli=true → test debe pasar (demuestra vulnerabilidad).

SQLi en /secure con -Dexpect.sqli=false → test debe fallar (la app resiste).

🧠 Lo que aprendí (resumido, estilo Mitnick)

Cómo una sola concatenación insegura ('$usuario') abre la puerta a la base. 🔓

Strategies para mitigar: PDO prepared, validación de entradas y password_hash. 🔒

Integración E2E con Serenity y manejo de WebDriver (timeouts, screenshots). ⏱️📸

CI en agente self-hosted: retos de acceso a localhost, variables -D desde pipeline y comillas en PowerShell. 🛠️

CDP/ChromeDriver: sincronizar versiones o añadir selenium-devtools-v{major} para evitar warnings. 🧩

🔥 Retos vencidos (breve)

Parametrizar ejecución (vulnerable vs secure) con -Dexpect.sqli.

Capturar evidencia automática (screenshots + JSON/HTML).

Ajustar selectores y timeouts para que los tests sean estables en entornos locales.

🧪 Ideas para seguir (próximos pasos)

Integrar OWASP ZAP como etapa de scan en pipeline.

Migrar backend a una API (Spring Boot) y practicar vulnerabilidades de APIs (auth, rate-limit, IDOR).

Añadir fuzzing + auditoría de inputs.

Implementar pruebas de regresión automáticas al cambiar el código.
