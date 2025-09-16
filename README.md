# 🌐 **API Hub: 10 APIs**

**API Hub** es un portal web dinámico y responsivo desarrollado en PHP que integra **10 APIs externas** para ofrecer experiencias interactivas y educativas. Este proyecto es una demostración de la integración de APIs, el desarrollo web moderno y la creación de interfaces intuitivas. 

<div align="center">
  <img src="https://github.com/lovecrimecode/API_Hub/blob/main/demo-screenshot.png" alt="Demo del Proyecto" width="800">
  <br>
</div>

## 🚀 **Características Destacadas**

- **Interfaz Responsiva**: Diseñada con Bulma para móviles y desktops.
- **Carga Dinámica**: Overlays de loading y iframes que se expanden solo cuando hay resultados.
- **Seguridad y UX**: Validación de inputs, manejo de errores y botones de "retry" sin recargar la página.
- **10 Herramientas Únicas**: Cada una con su API dedicada, desde predicciones hasta generación de contenido.

### 📋 **Las 10 Herramientas Impulsadas por APIs**

| # | Herramienta | Descripción | API Usada |
|---|-------------|-------------|-----------|
| 1 | 👦👧**Predicción de Género**  | Predice el género basado en un nombre con probabilidades estadísticas. | [Genderize.io](https://api.genderize.io/?name={...}) |
| 2 | 🎂**Predicción de Edad**  | Estima la edad promedio por nombre usando datos demográficos. | [Agify.io](https://api.agify.io/?name={...}) |
| 3 | 🎓**Universidades por País**  | Lista universidades con sitios web y dominios. | [Hipolabs Universities](http://universities.hipolabs.com/search?country={...}) |
| 4 | 🌦️**Clima en RD**  | Clima actual en ciudades dominicanas. | [WeatherAPI](https://api.weatherapi.com/) |
| 5 | ⚡**Info de Pokémon**  | Detalles completos: imagen, habilidades y stats. | [PokéAPI](https://pokeapi.co/api/v2/pokemon/{...}) |
| 6 | 📰**Noticias de WordPress**  | Últimas publicaciones de sitios como NASA o TechCrunch. | [WordPress REST API]({site}/wp-json/wp/v2/posts) |
| 7 | 💰**Conversión de Monedas**  | USD a DOP con tasas en tiempo real. | [ExchangeRate-API](https://api.exchangerate-api.com/v4/latest/USD) |
| 8 | 🖼️**Generador de Imágenes IA**  | Crea arte desde texto con IA. | [ImagePig API](https://api.imagepig.com/) |
| 9 | 🌍**Datos de un País**  | Población, capital, bandera y más. | [RestCountries](https://restcountries.com/v3.1/name/{...}) | 
| 10 | 🤣**Generador de Chistes**  | Chistes aleatorios en inglés para un toque de humor. | [Official Joke API](https://official-joke-api.appspot.com/random_joke) |


## 🛠️ **Tecnologías Utilizadas**

Elegí estas tecnologías para equilibrar simplicidad, rendimiento y escalabilidad, haciendo el proyecto accesible para principiantes mientras demuestra habilidades avanzadas.

- **PHP 8+** 💙 es la base del servidor: maneja formularios, integra APIs con `file_get_contents` y `curl`, y procesa JSON dinámicamente.
  
- **Bulma CSS** 🎨 es unframework CSS ligero y modular para layouts responsivos. Ofrece componentes listos como cards, tablas y modales sin JavaScript, asegurando compatibilidad cross-browser.

- **Font Awesome 6** 🔍 brinda íconos vectoriales escalables que añaden personalidad. Su biblioteca gratuita y fácil integración con Bulma eleva la UX sin peso extra.

- **JavaScript** ⚡para interactividad ligera: overlays de carga, ajuste dinámico de iframes y validación de Enter. Evité librerías pesadas para mantener el proyecto liviano.

- **APIs Externas** 🌐 10 APIs gratuitas. Demuestran manejo de solicitudes HTTP, manejo de errores y optimización de respuestas JSON.

## 📦 **Instalación Rápida**

1. **Clona el Repo**:
   ```bash
   git clone https://github.com/lovecrimecode/API_Hub.git
   cd API_Hub
   ```

2. **Ejecuta el Servidor PHP**:
   ```bash
   php -S localhost:8000
   ```

3. **Abre en el Navegador**:
   [http://localhost:8000](http://localhost:8000) – ¡Listo para probar!

**Requisitos**: PHP 8+, navegador moderno.

## 🎯 **Uso y Ejemplos**

- **Predicción de Género**: Ingresa "Juan" → "Masculino (95% probabilidad)".
- **Generador de Imágenes**: "Gato astronauta" → Imagen IA generada al instante.
- **Datos de País**: "Mexico" → Población: 126M, Capital: CDMX, Bandera: 🇲🇽.
