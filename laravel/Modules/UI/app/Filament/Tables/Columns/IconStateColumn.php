<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Tables\Columns;

use Exception;
use Filament\Forms\Get;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Spatie\ModelStates\State;
use Modules\SaluteOra\Models\User;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Spatie\ModelStates\HasStatesContract;
use Modules\Xot\Actions\Cast\SafeStringCastAction;

class IconStateColumn extends IconColumn
{

    protected function setUp(): void
    {
        parent::setUp();
        
        // Configure the column with state-based icon, color, and tooltip
        $this->icon(fn($state): ?string => $state?->icon());
        $this->color(fn($state): ?string => $state?->color());
        $this->tooltip(fn($state): ?string => $state?->label());

        // Add action for changing state
        $this->action(Action::make('change-state')
            ->form([
                Select::make('state')
                    ->options(
                        function (Model&HasStatesContract $record, string $state): array {
                            $name = $this->getName();
                            $state = $record->getAttribute($name);
                            
                            if ($state == null) {
                                $states = Arr::wrap($record->getDefaultStateFor($name));
                                return array_combine($states, $states);
                            }
                            
                            Assert::isInstanceOf($state, State::class);
                            
<<<<<<< HEAD
                            try {
                                $states = $state->transitionableStates();
                            } catch (Exception $e) {
                                $states = $record->getStatesFor($name)->toArray();
=======
                            try{
                                $states=$state->transitionableStates();
                            }catch(Exception $e){
                                $states=$record->getStatesFor($name)->toArray();;
>>>>>>> be3ca71 (.)
                            }
                            
                            /** @phpstan-ignore-next-line */
<<<<<<< HEAD
                            $states = Arr::mapWithKeys($states, function($state) use ($record) {
                                $model = Str::of(class_basename($record))->slug()->toString();
=======
                            $states=Arr::mapWithKeys($states,function($state) use ($record){
                                $model=Str::of(class_basename($record))->slug()->toString();
>>>>>>> be3ca71 (.)
                                /** @phpstan-ignore binaryOp.invalid */
                                Assert::string($label = __('pub_theme::'.$model.'_states.'.$state.'.label'));
                                return [$state => $label];
                            });
<<<<<<< HEAD
                            
=======
>>>>>>> be3ca71 (.)
                            return $states;
                        }
                    )
                    ->required()
                    ->reactive(),
<<<<<<< HEAD
                    
                Textarea::make('message')
<<<<<<< HEAD
                    ->required(function(Get $get, $record) {
                        $newState = app(SafeStringCastAction::class)->execute($get('state'));
                        $name = $this->getName();
                        $state = $record->getAttribute($name);
                        $states = $state::getStateMapping();
                        
                        /** @var class-string<\Spatie\ModelStates\State> $newStateClass */
                        $newStateClass = Arr::get($states, (string) $newState);
                        
                        if (!is_string($newStateClass) || !class_exists($newStateClass)) {
                            return false;
                        }
                        
                        $newStateInstance = new $newStateClass($record);
                        return method_exists($newStateInstance, 'isMessageRequired') 
                            ? $newStateInstance->isMessageRequired() 
                            : false;
                    }),
=======
                ->required(function(Get $get,$record){
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                    $newState=app(SafeStringCastAction::class)->execute($get('state'));
=======
                    $newState=$get('state');
>>>>>>> 41f976e (.)
=======
                    $newState=$get('state');
>>>>>>> 51da2b43 (.)
=======
                    $newState=$get('state');
>>>>>>> 8727c5b (.)
=======
                Textarea::make('message')
                ->required(function(Get $get,$record){
                    $newState=$get('state');
>>>>>>> be3ca71 (.)
                    $name=$this->getName();
                    $state=$record->getAttribute($name);
                    $states=$state::getStateMapping();
                    /** @var class-string<\Spatie\ModelStates\State> $newStateClass */
                    $newStateClass=Arr::get($states, (string) $newState);
                    if (!is_string($newStateClass) || !class_exists($newStateClass)) {
                        return false;
                    }
                    $newStateInstance=new $newStateClass($record);
                    return method_exists($newStateInstance, 'isMessageRequired') 
                        ? $newStateInstance->isMessageRequired() 
                        : false;
                }),
<<<<<<< HEAD
>>>>>>> bbf3ab4 (.)
=======
>>>>>>> be3ca71 (.)
            ])
            ->fillForm(function($record) {
                return [
                    'state' => $record->state::$name,
                ];
            })
            ->action(function($record, $data) {
                $record->state->transitionTo($data['state'], $data['message']);
            })
        );
    }
}
