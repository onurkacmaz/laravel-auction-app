import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';
import tr_TR from 'filepond/locale/tr-tr';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

FilePond.setOptions(tr_TR)
FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType, FilePondPluginFileEncode, FilePondPluginFileMetadata)

const elems = document.querySelectorAll('.filepond')
if (elems) {
    elems.forEach(elem => {
        let images = elem.getAttribute('data-file-metadata-images')

        const filepond = FilePond.create(elem, {
            acceptedFileTypes: ['image/*'],
            allowFileEncode: true,
            allowFileMetadata: true
        })

        if (images) {
            images = JSON.parse(images)
            filepond.setOptions({
                files: images
            })
        }
    })
}
