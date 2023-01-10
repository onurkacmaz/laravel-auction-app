import 'quill/dist/quill.snow.css';
import Quill from "quill";

let container = document.querySelector('.quill-editor')
if (container) {
    let quill = new Quill(container, {
        modules: {
            toolbar: [
                [{header: [1, 2, false]}],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        },
        theme: 'snow'
    });
    if (!quill.container.dataset.input) {
        throw new Error("data-input attribute is required on .quill-editor");
    }
    quill.on('text-change', function () {
        document.getElementById(quill.container.dataset.input).value = quill.root.innerHTML;
    });
}
