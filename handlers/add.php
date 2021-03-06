<?php

$this->require_admin ();

$page->layout = 'admin';
$page->title = i18n_get ('Add question');

$form = new Form ('post', $this);

$form->data = array (
	'categories' => faq\Category::query ()->order ('name', 'asc')->fetch_assoc ('id', 'name')
);

$this->run ('admin/util/wysiwyg', array ('field_id' => 'webpage-body'));

echo $form->handle (function ($form) {
	// Create and save a new faq
	$faq = new faq\Faq (array (
		'question' => $_POST['question'],
		'answer' => $_POST['answer'],
		'category' => $_POST['category'],
		'sort' => faq\Faq::next_num ()
	));
	$faq->put ();

	if ($faq->error) {
		// Failed to save
		$form->controller->add_notification (i18n_get ('Unable to save question.'));
		return false;
	}

	// Save a version of the faq
	Versions::add ($faq);

	// Notify the user and redirect on success
	$form->controller->add_notification (i18n_get ('Question added.'));
	$form->controller->redirect ('/faq/admin');
});

?>