Perfecto — este ejemplo es muy bueno porque conecta directamente con APIs (como las que tú estás construyendo) 🔥

Vamos a implementar **FORMATEO DE RESPUESTA usando Decorator** paso a paso.

---

# 🧱 🧠 Escenario

Tienes un servicio que genera datos:

```text
ReportService → devuelve datos en array
```

Pero quieres poder devolver:

* JSON
* XML
* HTML

👉 Sin modificar el servicio original

---

# 🔧 1. Interface (contrato común)

```php
<?php
// app/Contracts/Report.php

interface Report
{
    public function generate(): array;
}
```

---

# 🧩 2. Servicio base (núcleo)

```php
<?php
// app/Services/ReportService.php

class ReportService implements Report
{
    public function generate(): array
    {
        return [
            'title' => 'Sales Report',
            'total' => 1500,
            'currency' => 'USD'
        ];
    }
}
```

👉 Este es el **core** (NO lo queremos modificar)

---

# 🧱 3. Decorator base

```php
<?php
// app/Decorators/ReportDecorator.php

abstract class ReportDecorator implements Report
{
    protected Report $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function generate(): array
    {
        return $this->report->generate();
    }
}
```

---

# 🎨 4. Decorator: JSON

```php
<?php
// app/Decorators/JsonReport.php

class JsonReport extends ReportDecorator
{
    public function generate(): string
    {
        $data = $this->report->generate();
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
```

---

# 📄 5. Decorator: XML

```php
<?php
// app/Decorators/XmlReport.php

class XmlReport extends ReportDecorator
{
    public function generate(): string
    {
        $data = $this->report->generate();

        $xml = new SimpleXMLElement('<report/>');

        foreach ($data as $key => $value) {
            $xml->addChild($key, $value);
        }

        return $xml->asXML();
    }
}
```

---

# 🌐 6. Decorator: HTML

```php
<?php
// app/Decorators/HtmlReport.php

class HtmlReport extends ReportDecorator
{
    public function generate(): string
    {
        $data = $this->report->generate();

        $html = "<h1>{$data['title']}</h1>";
        $html .= "<p>Total: {$data['total']} {$data['currency']}</p>";

        return $html;
    }
}
```

---

# 🚀 7. Uso (lo importante)

```php
<?php

$report = new ReportService();

// JSON
$jsonReport = new JsonReport($report);
echo $jsonReport->generate();

echo "<hr>";

// XML
$xmlReport = new XmlReport($report);
echo $xmlReport->generate();

echo "<hr>";

// HTML
$htmlReport = new HtmlReport($report);
echo $htmlReport->generate();
```

---

# 🧠 🔥 ¿Qué está pasando aquí?

* `ReportService` → genera datos base
* Cada decorator:

  * llama al original
  * transforma el resultado

---

# 🎯 Resultado conceptual

```text
ReportService → array
   ↓
JsonReport → string JSON

ReportService → array
   ↓
XmlReport → string XML

ReportService → array
   ↓
HtmlReport → string HTML
```

---

# ⚡ Insight importante

Aquí el Decorator:

> ❗ NO cambia el comportamiento base
> ❗ SOLO transforma el resultado

---

# 🚀 Nivel PRO (lo que tú deberías ver)

Esto es EXACTAMENTE lo que hacen frameworks:

* Laravel → Resources / Transformers
* APIs → serializers
* Symfony → normalizers

---

# 🧠 Conclusión

Este ejemplo es Decorator porque:

* Envuelves el servicio base
* Delegas la ejecución
* Modificas el resultado al regresar

---

Si quieres el siguiente nivel 🔥

👉 Lo integramos a tu **Response.php de redsky-mvc-api** para que soporte:

* JSON automático
* XML opcional
* formateadores dinámicos

Eso ya es arquitectura real 🚀
