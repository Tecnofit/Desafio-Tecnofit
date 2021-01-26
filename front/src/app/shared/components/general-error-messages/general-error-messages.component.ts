import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-general-error-messages',
  templateUrl: './general-error-messages.component.html',
  styleUrls: ['./general-error-messages.component.css']
})
export class GeneralErrorMessagesComponent implements OnInit {

  @Input('general-error-messages') generalErrorMessages: string = null;

  constructor() { }

  ngOnInit() {
  }

}
