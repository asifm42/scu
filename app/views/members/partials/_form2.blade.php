Former::horizontal_open()
  ->id('MyForm')
  ->secure()
  ->rules(['name' => 'required'])
  ->method('GET');

  Former::xlarge_text('name')
    ->class('myclass')
    ->value('Joseph')
    ->required();

  Former::text('lastname')
    ->class('myclass')
    ->value('Smith')
    ->required();

  Former::textarea('comments')
    ->rows(10)->columns(20)
    ->autofocus();

  Former::actions()
    ->large_primary_submit('Submit')
    ->large_inverse_reset('Reset');

Former::close();