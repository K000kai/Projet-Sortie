const form = document.getElementById('outing_form');
const form_select_city = document.getElementById('outing_city');
const form_select_location = document.getElementById('outing_location');


const updateForm = async (data, url, method) => {
    const req = await fetch(url, {
        method: method,
        body: data,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'charset': 'utf-8'
        }

    });

    const text = await req.text();

    return text;
};


const parseTextToHtml = (text) => {
    const parser = new DOMParser();
    const html = parser.parseFromString(text, 'text/html');

    return html;
};

const changeOptions = async (e) => {
    const requestBody = e.target.getAttribute('name') + '=' + e.target.value;
    const updateFormResponse = await updateForm(requestBody, form.getAttribute('action'), form.getAttribute('method'));
    const html = parseTextToHtml(updateFormResponse);

    const new_form_select_location = html.getElementById('outing_location');
    form_select_location.innerHTML = new_form_select_location.innerHTML;
};

form_select_city.addEventListener('change', async (e) => changeOptions(e));
