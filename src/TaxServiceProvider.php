<?php

namespace Branzia\Tax;
use Filament\Forms\Form;
use Branzia\Tax\Models\TaxClass;
use Illuminate\Support\Facades\File;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Branzia\Customer\Models\CustomerGroup;
use Branzia\Blueprint\BranziaServiceProvider;
use Branzia\Bootstrap\Form\FormExtensionManager;
use Branzia\Bootstrap\Table\TableExtensionManager;
use Branzia\Customer\Filament\Resources\CustomerGroupResource;

/**
 * TaxServiceProvider
 * 
 * This service provider extends the `CustomerGroupResource` by injecting additional form fields
 * and table columns from the Tax module — without modifying the original customer module.
 * 
 * Features:
 * ---------
 * ✅ Adds a `tax_class_id` select field (relationship to TaxClass model) to the CustomerGroup form.
 * ✅ Displays the selected Tax Class name as a column in the CustomerGroup table.
 * ✅ Dynamically resolves the `taxClass` relationship in the CustomerGroup model at runtime.
 * ✅ Uses centralized extension managers (`FormExtensionManager`, `TableExtensionManager`) for modularity.
 * 
 * Integration Points:
 * -------------------
 * - FormExtensionManager: Appends new fields to the form schema using positioning (`after: code`).
 * - TableExtensionManager: Appends a column to the table schema and places it after `code`.
 * 
 * Usage:
 * ------
 * This service provider is automatically loaded via the `BranziaServiceProvider`.
 * Ensure it is registered in the main bootstrap or module loading logic.
 * 
 * Example:
 * --------
 * Tax Class Select Field (Form):
 * ------------------------------
 * [
 *     'field' => Select::make('tax_class_id')
 *         ->relationship('taxClass', 'name')
 *         ->label('Tax Class')
 *         ->required()
 *         ->nullable()
 *         ->preload(),
 *     'after' => 'code',
 * ]
 * 
 * Tax Class Column (Table):
 * --------------------------
 * [
 *     'column' => TextColumn::make('taxClass.name')->label('Tax Class')->sortable(),
 *     'after' => 'code',
 * ]
 */

class TaxServiceProvider extends BranziaServiceProvider
{
     public function moduleName(): string
    {
        return 'Tax';
    }
    public function moduleRootPath():string{
        return dirname(__DIR__);
    }

    public function boot(): void
    {
        parent::boot();

        CustomerGroup::retrieved(function ($model) {
            $model->mergeFillable(['CustomerGroup']);
        });
        // Or if working with new models
        CustomerGroup::creating(function ($model) {
            $model->mergeFillable(['CustomerGroup']);
        });
        CustomerGroup::resolveRelationUsing('taxClass', function ($model) {
            return $model->belongsTo(TaxClass::class, 'tax_class_id');
        });
    }

    public function register(): void
    {
        parent::register();
        $this->loadFormExtensions();
        $this->loadTableExtensions();
    }

    protected function loadFormExtensions(): void
    {
        
        FormExtensionManager::register(CustomerGroupResource::class, fn () => [
            ['field' => Select::make('tax_class_id')->relationship(
                name: 'taxClass',
                titleAttribute: 'name',
                modifyQueryUsing: fn ($query) => $query->where('type', 'customer')
            )->label('Customer Group')->required()->label('Tax Class')->preload()->nullable(), 'after' => 'code'],
        ]);  
        
    }

    protected function loadTableExtensions(): void
    {
        TableExtensionManager::register(CustomerGroupResource::class, fn () => [[
            'column' => TextColumn::make('taxClass.name')->label('Tax Class')->sortable(),
            'after' => 'code', //  Position it after 'code' column
        ]]);  
    }

}

