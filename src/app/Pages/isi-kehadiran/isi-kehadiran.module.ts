import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { IsiKehadiranPageRoutingModule } from './isi-kehadiran-routing.module';

import { IsiKehadiranPage } from './isi-kehadiran.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    IsiKehadiranPageRoutingModule
  ],
  declarations: [IsiKehadiranPage]
})
export class IsiKehadiranPageModule {}
