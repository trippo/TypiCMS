<?php
namespace TypiCMS\Providers;

use TypiCMS\Services\Form\FormBuilder;
use AdamWathan\BootForms\BootFormsServiceProvider as OriginalBootFormsServiceProvider;

class BootFormsServiceProvider extends OriginalBootFormsServiceProvider {

	protected function registerFormBuilder()
	{
		$this->app['adamwathan.form'] = $this->app->share(function($app)
		{
			$formBuilder = new FormBuilder;
			$formBuilder->setErrorStore($app['adamwathan.form.errorstore']);
			$formBuilder->setOldInputProvider($app['adamwathan.form.oldinput']);
			$formBuilder->setToken($app['session.store']->getToken());
			// dd($formBuilder);
			return $formBuilder;
		});
	}
}
