document.addEventListener('DOMContentLoaded', function() {
    const sectionsContainer = document.getElementById('sectionsContainer');
    const addSectionButton = document.getElementById('addSection');
    const savePageButton = document.getElementById('savePage');
    const pageNameInput = document.getElementById('pageName');
    const previewContainer = document.getElementById('previewContainer');

    addSectionButton.addEventListener('click', addSection);
    sectionsContainer.addEventListener('input', updatePreview);
    sectionsContainer.addEventListener('change', updatePreview);
    savePageButton.addEventListener('click', savePage);
    sectionsContainer.addEventListener('click', function(event) {
        // Asegúrate de que el clic se detecte si se realiza en el botón o en el ícono dentro del botón
        let target = event.target;

        // Verificar si el clic fue en el ícono dentro del botón
        if (target.tagName === 'I' && target.parentElement.classList.contains('btn')) {
            target = target.parentElement;
        }

        // Verificar si el clic fue en el botón (o el ícono como se ajustó)
        if (target.classList.contains('btn')) {
            const content = target.nextElementSibling;
            content.style.display = content.style.display === 'none' || content.style.display === '' ? 'block' : 'none';

            if (content.style.display === 'block') {
                target.innerHTML = 'CERRAR  <i class="fa-regular fa-circle-xmark"></i></i>';
                target.classList.remove('btn-outline-primary');
                target.classList.add('btn-outline-primary');
                target.style.transition = 'background-color 0.3s ease, color 0.3s ease'; // Agregar transición
            } else {
                target.innerHTML = 'OPCIONES <i class="fa-solid fa-sliders"></i></i>';
                target.classList.remove('btn-outline-primary');
                target.classList.add('btn-outline-primary');
                target.style.transition = 'background-color 0.3s ease, color 0.3s ease'; // Agregar transición
            }
        }
    });




    function addSection() {
        const sectionType = document.getElementById('sectionType').value;
        let sectionHTML = '';

        switch (sectionType) {
            case '1': // Título
                sectionHTML = `
            <div class="section">
                        <label for="title">Título:</label>
                        <input type="text" class="section-title" placeholder="Ingrese aquí su título" id="section-title" required >
                        <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                        <button type="button" class="btn btn-outline-primary" id="btnb" > OPCIONES <i class="fa-solid fa-sliders"></i></button>
                <div class="configContent" style="display: none;">
                        <label for="color-title"> Elige el color del titulo:</label>
                        <input type="color" class="section-title-color" value="#000000">
                        <br>
                        <label for="alin-title"> Elige la alineación del titulo:</label>
                    <select class="section-title-alignment">
                        <option value="left">Izquierda</option>
                        <option value="center">Centro</option>
                        <option value="right">Derecha</option>
                    </select>
                        <label for="alin-title">Tamaño:</label>
                        <input type="number" class="section-title-font-size" placeholder="Tamaño fuente (px)" min="1" value="24"  required > 
                        <label for="alin-title">Tipografía:</label>
                    <select class="section-title-font-family">
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                    </select>
                </div>
            </div>
`;
                break;
            case '2': // Texto

                sectionHTML = `
            <div class="section">
                    <label for="text">Texto:</label>
                    <textarea class="section-text" placeholder="Ingrese aquí su texto" required ></textarea>
                    <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="btn btn-outline-primary" id="btnb"> OPCIONES <i class="fa-solid fa-sliders"></i></button>
                <div class="configContent" style="display: none;">
                    <label for="text">Color de Texto:</label>
                    <input type="color" class="section-text-color" value="#000000"> <br>
                    <label for="text">Alineación Texto:</label>
                    <select class="section-text-alignment">
                    <option value="left">Izquierda</option>
                    <option value="center">Centro</option>
                    <option value="right">Derecha</option>
                    </select>
                    <label for="text">Tamaño Texto:</label>
                    <input type="number" class="section-text-font-size" placeholder="Tamaño fuente (px)" min="1" value="16" required >
                    <label for="text">Fuente Texto:</label>
                    <select class="section-text-font-family">
                    <option value="Arial">Arial</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Verdana">Verdana</option>
                    </select>
                </div>
            </div>`;
                break;
            case '3': // Imagen
                sectionHTML = `
            <div class="section">
             <div class="td1">
            <div class="section1">
                    <label for="imagen">Imagen: </label><br>
                      <input type="file" class="section-image form-control me-2" id="inputGroupFile01" required >
                    </div>
                   <div class="section2">
                    <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="btn btn-outline-primary" id="btnb"> OPCIONES <i class="fa-solid fa-sliders"></i></button>
                    
                    <div class="configContent" style="display: none;">
                    <label for="timagen">Tamaño Imagen:</label>
                    <input type="number" class="section-image-width" placeholder="Ancho (px)" min="1" value="700" required >
                    <input type="hidden" class="section-image-height" placeholder="Alto (px)" min="1" value="auto" >
                    <label for="timagen">Alineación Imagen:</label>
                    <select class="section-image-alignment">
                    <option value="left">Izquierda</option>
                    <option value="center">Centro</option>
                    <option value="right">Derecha</option>
                    </select>                        
                </div>
                    </div>
                    </div>
                    
                
            </div>`;
                break;
            case '4': // video
                sectionHTML = `
            <div class="section">
                <div class="td1">
                    <div class="section1">
                        <label for="video">video:</label>
                        <input type="file" class="section-video form-control me-2" id="inputGroupFile01" required >
                    </div>
                    <div class="section2">
                        <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                        <button type="button" class="btn btn-outline-primary" id="btnb"> OPCIONES <i class="fa-solid fa-sliders"></i></button>
                    <div class="configContent" style="display: none;">
                        <label for="tvideo">Tamaño video:</label>
                        <input type="number" class="section-video-width" placeholder="Ancho (px)" min="1" value="700" required >
                        <input type="hidden" class="section-video-height" placeholder="Alto (px)" min="1" value="auto" >
                        <label for="tvideo">Alineación video:</label>
                        <select class="section-video-alignment">
                        <option value="left">Izquierda</option>
                        <option value="center">Centro</option>
                        <option value="right">Derecha</option>
                        </select>                        
                    </div>
                    </div>
                </div>
            </div>`;
                break;
            case '5': // URL
                sectionHTML = `
            <div class="section">
                    <label for="url">URL:</label>
                    <input type="text" class="section-url" placeholder="Ingrese la URL" required >
                    <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                <div class="configContent" style="display: none;">   
                </div>
            </div>`;
                break;
            case '6': // Título y Texto
                sectionHTML = `
                    <div class="section">
                        <label for="title">Título:</label>
                        <input type="text" class="section-title" placeholder="Ingrese aquí su título" required >
                        <label for="text">Texto:</label>
                        <textarea class="section-text" placeholder="Ingrese aquí su texto" required ></textarea>
                        <button class="removeSection">Eliminar <i class="fa-solid fa-xmark"></i></button>
                        <button type="button" class="btn btn-outline-primary" id="btnb"> OPCIONES <i class="fa-solid fa-sliders"></i></button>
                    <div class="configContent" style="display: none;">
                        <label for="title">Color Título:</label>
                        <input type="color" class="section-title-color" value="#000000"> <br>
                        <label for="title">Alineación Título:</label>
                        <select class="section-title-alignment">
                        <option value="left">Izquierda</option>
                        <option value="center">Centro</option>
                        <option value="right">Derecha</option>
                        </select>
                        <label for="title">Tamaño Título:</label>
                        <input type="number" class="section-title-font-size" placeholder="Tamaño fuente (px)" min="1" value="24" required >
                        <label for="title">Fuente Título:</label>
                        <select class="section-title-font-family">
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        </select>
                        <br>
                        <label for="title">Color Texto:</label>
                        <input type="color" class="section-text-color" value="#000000"> <br>
                        <label for="title">Alineación Título:</label>
                        <select class="section-text-alignment">
                        <option value="left">Izquierda</option>
                        <option value="center">Centro</option>
                        <option value="right">Derecha</option>
                        </select>
                        <label for="title">Tamaño Texto:</label>
                        <input type="number" class="section-text-font-size" placeholder="Tamaño fuente (px)" min="1" value="16" required >
                        <label for="title">Fuente Texto:</label>
                        <select class="section-text-font-family">
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        </select>
                    </div>
                    </div>`;
                break;
        }

        const newSection = document.createElement('div');
        newSection.classList.add('section-wrapper');
        newSection.innerHTML = sectionHTML;
        sectionsContainer.appendChild(newSection);

        newSection.querySelector('.removeSection').addEventListener('click', removeSection);
    }

    function removeSection(event) {
        event.target.closest('.section-wrapper').remove();
        updatePreview();
    }

    function updatePreview() {
        // Limpia el contenido del contenedor de vista previa
        previewContainer.innerHTML = '';

        // Crear el elemento de navegación
        const nav = document.createElement('nav');
        nav.classList.add('navbar', 'navbar-expand-lg', 'navbar-light', 'bg-light'); // Clases de Bootstrap para estilo

        // Crear el contenedor del navbar
        const container = document.createElement('div');
        container.classList.add('container');

        // Crear el contenedor para la imagen del navbar
        const navbarBrand = document.createElement('a');
        navbarBrand.classList.add('navbar-brand');
        navbarBrand.setAttribute('href', '#');

        // Crear la imagen del navbar
        const logoImg = document.createElement('img');
        logoImg.src = 'uploads/logo-ut.png'; // Reemplaza con la ruta a tu imagen
        logoImg.alt = 'Logo';
        logoImg.style.height = '40px'; // Ajusta el tamaño de la imagen según sea necesario
        logoImg.style.width = 'auto'; // Mantén la proporción de la imagen

        // Añadir la imagen al contenedor de la marca
        navbarBrand.appendChild(logoImg);

        // Crear el botón del menú (para dispositivos móviles)
        const navbarToggler = document.createElement('button');
        navbarToggler.classList.add('navbar-toggler');
        navbarToggler.setAttribute('type', 'button');
        navbarToggler.setAttribute('data-toggle', 'collapse');
        navbarToggler.setAttribute('data-target', '#navbarNav');
        navbarToggler.setAttribute('aria-controls', 'navbarNav');
        navbarToggler.setAttribute('aria-expanded', 'false');
        navbarToggler.setAttribute('aria-label', 'Toggle navigation');
        navbarToggler.innerHTML = '<span class="navbar-toggler-icon"></span>';

        // Crear el menú de navegación
        const collapse = document.createElement('div');
        collapse.classList.add('collapse', 'navbar-collapse');
        collapse.setAttribute('id', 'navbarNav');

        // Crear la lista de navegación
        const ul = document.createElement('ul');
        ul.classList.add('navbar-nav');

        // Crear elementos de lista para el menú
        const navItems = ['Inicio', 'Sobre nosotros', 'Servicios', 'Contacto']; // Ejemplos de ítems
        navItems.forEach(item => {
            const li = document.createElement('li');
            li.classList.add('nav-item');
            const a = document.createElement('a');
            a.classList.add('nav-link');
            a.setAttribute('href', '#');
            a.textContent = item;
            li.appendChild(a);
            ul.appendChild(li);
        });

        // Añadir elementos al contenedor
        collapse.appendChild(ul);
        container.appendChild(navbarBrand); // Añadir la marca (imagen) al contenedor
        container.appendChild(navbarToggler);
        container.appendChild(collapse);
        nav.appendChild(container);

        // Añadir el navbar al contenedor de vista previa
        previewContainer.appendChild(nav);

        // Aquí puedes añadir más contenido de vista previa si es necesario




        sectionsContainer.querySelectorAll('.section-wrapper').forEach(section => {
            const previewElement = document.createElement('div');
            previewElement.classList.add('preview-element');

            if (section.querySelector('.section-title')) {
                const title = section.querySelector('.section-title').value;
                const color = section.querySelector('.section-title-color').value;
                const alignment = section.querySelector('.section-title-alignment').value;
                const fontSize = section.querySelector('.section-title-font-size').value;
                const fontFamily = section.querySelector('.section-title-font-family').value;
                const titleElement = document.createElement('h1');
                titleElement.innerText = title;
                titleElement.style.color = color;
                titleElement.style.textAlign = alignment;
                titleElement.style.fontSize = `${fontSize}px`;
                titleElement.style.fontFamily = fontFamily;
                previewElement.appendChild(titleElement);
            }

            if (section.querySelector('.section-text')) {
                const text = section.querySelector('.section-text').value;
                const color = section.querySelector('.section-text-color').value;
                const alignment = section.querySelector('.section-text-alignment').value;
                const fontSize = section.querySelector('.section-text-font-size').value;
                const fontFamily = section.querySelector('.section-text-font-family').value;

                const textElement = document.createElement('p');
                textElement.innerText = text;
                textElement.style.color = color;
                textElement.style.textAlign = alignment;
                textElement.style.fontSize = `${fontSize}px`;
                textElement.style.fontFamily = fontFamily;
                textElement.style.wordWrap = 'break-word'; // Ensures text wraps properly
                textElement.style.overflowWrap = 'break-word'; // Ensures text wraps properly
                textElement.style.maxWidth = '100%'; // Ensures the text element does not exceed the container width

                previewElement.appendChild(textElement);
            }


            if (section.querySelector('.section-image')) {
                const imageInput = section.querySelector('.section-image');
                const width = section.querySelector('.section-image-width').value;
                const height = section.querySelector('.section-image-height').value;
                const alignment = section.querySelector('.section-image-alignment').value;

                if (imageInput.files && imageInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.width = `${width}px`;
                        imgElement.style.height = `${height}`;
                        imgElement.style.display = 'block'; // Ensure it's treated as a block-level element
                        imgElement.style.margin = '0'; // Reset margins

                        // Create a container to handle alignment
                        const imgContainer = document.createElement('div');
                        imgContainer.style.width = '100%'; // Ensure the container takes full width
                        imgContainer.style.position = 'relative'; // Ensure the container is in normal document flow

                        // Adjust alignment based on selected option
                        if (alignment === 'center') {
                            imgContainer.style.display = 'flex'; // Use flexbox to center the image
                            imgContainer.style.justifyContent = 'center'; // Center horizontally
                            imgContainer.style.alignItems = 'center'; // Center vertically
                        } else if (alignment === 'left') {
                            imgContainer.style.display = 'block'; // Default block display
                            imgElement.style.marginLeft = '0'; // Align to the left
                            imgElement.style.marginRight = 'auto'; // Push the image to the left
                        } else if (alignment === 'right') {
                            imgContainer.style.display = 'flex'; // Use flexbox to align the image
                            imgContainer.style.justifyContent = 'flex-end'; // Align to the right
                        }

                        imgContainer.appendChild(imgElement);
                        previewElement.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(imageInput.files[0]);
                }
            }


            if (section.querySelector('.section-video')) {
                const videoInput = section.querySelector('.section-video');
                const width = section.querySelector('.section-video-width').value;
                const height = section.querySelector('.section-video-height').value;
                const alignment = section.querySelector('.section-video-alignment').value;

                if (videoInput.files && videoInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const videoElement = document.createElement('video');
                        videoElement.src = e.target.result;
                        videoElement.controls = true;
                        videoElement.style.width = `${width}px`;
                        videoElement.style.height = `${height}px`;
                        videoElement.style.display = 'block'; // Asegura que el video se comporte como un bloque
                        videoElement.style.margin = '0'; // Restablece los márgenes

                        // Ajusta la alineación basada en la opción seleccionada
                        if (alignment === 'center') {
                            videoElement.style.margin = '0 auto'; // Centra horizontalmente
                        } else if (alignment === 'left') {
                            videoElement.style.marginLeft = '0'; // Alinea a la izquierda
                            videoElement.style.marginRight = 'auto'; // Restablece el margen derecho
                        } else if (alignment === 'right') {
                            videoElement.style.marginLeft = 'auto'; // Alinea a la derecha
                            videoElement.style.marginRight = '0'; // Restablece el margen izquierdo
                        }

                        previewElement.appendChild(videoElement);
                    };
                    reader.readAsDataURL(videoInput.files[0]);
                }
            }


            if (section.querySelector('.section-url')) {
                const url = section.querySelector('.section-url').value;
                const urlElement = document.createElement('a');
                urlElement.href = url;
                urlElement.innerText = url;
                urlElement.target = "_blank";
                previewElement.appendChild(urlElement);
            }

            previewContainer.appendChild(previewElement);
        });
    }

    function savePage() {
        const pageName = pageNameInput.value;
        const sections = [];

        sectionsContainer.querySelectorAll('.section-wrapper').forEach(section => {
            const sectionData = {};

            if (section.querySelector('.section-title')) {
                sectionData.title = section.querySelector('.section-title').value;
                sectionData.titleColor = section.querySelector('.section-title-color').value;
                sectionData.titleAlignment = section.querySelector('.section-title-alignment').value;
                sectionData.titleFontSize = section.querySelector('.section-title-font-size').value;
                sectionData.titleFontFamily = section.querySelector('.section-title-font-family').value;
            }

            if (section.querySelector('.section-text')) {
                sectionData.text = section.querySelector('.section-text').value;
                sectionData.textColor = section.querySelector('.section-text-color').value;
                sectionData.textAlignment = section.querySelector('.section-text-alignment').value;
                sectionData.textFontSize = section.querySelector('.section-text-font-size').value;
                sectionData.textFontFamily = section.querySelector('.section-text-font-family').value;
            }

            if (section.querySelector('.section-image')) {
                const imageInput = section.querySelector('.section-image');
                if (imageInput.files && imageInput.files[0]) {
                    sectionData.image = imageInput.files[0];
                    sectionData.imageWidth = section.querySelector('.section-image-width').value;
                    sectionData.imageHeight = section.querySelector('.section-image-height').value;
                    sectionData.imageAlignment = section.querySelector('.section-image-alignment').value;
                }
            }

            if (section.querySelector('.section-video')) {
                const videoInput = section.querySelector('.section-video');
                if (videoInput.files && videoInput.files[0]) {
                    sectionData.video = videoInput.files[0];
                    sectionData.videoWidth = section.querySelector('.section-video-width').value;
                    sectionData.videoHeight = section.querySelector('.section-video-height').value;
                    sectionData.videoAlignment = section.querySelector('.section-video-alignment').value;
                }
            }

            if (section.querySelector('.section-url')) {
                sectionData.url = section.querySelector('.section-url').value;
            }

            sections.push(sectionData);
        });

        const formData = new FormData();
        formData.append('pageName', pageName);
        formData.append('sections', JSON.stringify(sections));

        sections.forEach((section, index) => {
            if (section.image) {
                formData.append(`image_${index}`, section.image);
            }
            if (section.video) {
                formData.append(`video_${index}`, section.video);
            }
        });

        fetch('guardar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Página guardada con éxito');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
document.querySelector('.toggleConfig').addEventListener('click', function() {
    const content = document.querySelector('.configContent');
    content.style.display = content.style.display === 'none' || content.style.display === '' ? 'block' : 'none';
    this.innerHTML = content.style.display === 'block' ? 'CERRAR configuración <i class="fa fa-chevron-up"></i>' : 'Abrir configuración <i class="fa fa-chevron-down"></i>';
});