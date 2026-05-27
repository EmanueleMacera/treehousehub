<?php

return [
    'meta' => [
        'title' => 'Contact Us - TreeHouse Italia',
        'description' => 'Contact TreeHouse Italia for information about short-term rentals, property sales or property management. Phone: +39 019 8387211 | Email: info@treehouseitalia.it',
    ],
    'hero' => [
        'kicker' => 'Let\'s Talk',
        'title' => 'Contact Us',
        'subtitle' => 'Do you have questions about our services? Would you like a free valuation of your property? Our team is ready to help.',
    ],
    'info' => [
        'blocks' => [
            ['type' => 'phone', 'icon' => '+', 'title' => 'Phone', 'note' => 'Mon-Fri 9:00-18:00'],
            ['type' => 'email', 'icon' => '+', 'title' => 'Email', 'note' => 'We will reply within 24h'],
            ['type' => 'address', 'icon' => '+', 'title' => 'Registered Office', 'text' => 'Via Agostino Chiodo 6<br>17100 Savona (SV)<br>Italy'],
            ['type' => 'company', 'icon' => '+', 'title' => 'Company Details', 'lines' => ['TreeHouse Italia Srl', 'VAT: IT01581160098']],
        ],
    ],
    'form' => [
        'title' => 'Send a Message',
        'subtitle' => 'Fill in the form and we will contact you as soon as possible',
        'name' => 'Full Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'subject' => 'Subject',
        'subject_placeholder' => 'Select an option...',
        'subject_options' => [
            'valutazione' => 'Property valuation',
            'affitto' => 'Short-term rental - Owner',
            'prenotazione' => 'Structure booking',
            'vendita' => 'Property sale',
            'informazioni' => 'General information',
            'altro' => 'Other',
        ],
        'message' => 'Message',
        'privacy' => 'I accept the <a href=":url" class="form-link">privacy policy</a> and consent to the processing of my personal data *',
        'submit' => 'Send Message',
    ],
    'flash' => [
        'sent' => 'Message successfully sent.',
    ],
    'faq' => [
        'title' => 'Frequently Asked Questions',
        'subtitle' => 'Answers to the most common questions',
        'items' => [
            ['question' => 'How does the free valuation work?', 'answer' => 'Contact us to schedule a free inspection. Our experts will assess your property and provide an accurate projection of potential short-term rental earnings.'],
            ['question' => 'How long does it take to get a response?', 'answer' => 'Our team replies within 24 business hours to all requests by email or form. For urgent matters, call us directly at +39 019 8387211.'],
            ['question' => 'Can I visit your office?', 'answer' => 'Of course. Our office is in Savona at Via Agostino Chiodo 6. We recommend contacting us first to schedule an appointment and ensure a consultant is available.'],
        ],
    ],
    'cta' => [
        'title' => 'Prefer to Speak Directly?',
        'text' => 'Our team is available to answer all your questions',
        'call' => 'Call Us Now',
        'owners' => 'Owner Info',
    ],
];
