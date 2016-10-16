import { Schema } from 'jugglingdb';
import 'jugglingdb-arango';
import * as arango from 'arangojs';
import * as Baby from 'babyparse';
import fs from 'fs';
import { exec } from 'child_process';
import { username, password } from './credentials.js';
