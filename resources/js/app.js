import './bootstrap';
import {
    Livewire,
    Alpine,
} from '../../vendor/livewire/livewire/dist/livewire.esm'

Alpine.plugin(Tooltip)

Livewire.start()
