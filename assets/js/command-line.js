import { sendCommand } from './helpers/ajax.js';

let currentLine = 0;

const focusLine = () => {
  $(`#line-${currentLine}`).find('.command-content').focus();
};

const disableCurrentLine = () => {
  if (currentLine === 0) return;

  $(`#line-${currentLine}`)
    .find('.command-content')
    .attr({ contenteditable: false });
};

const appendNewResult = (text) => {
  const parent = $('#command-line');
  const template = $('#result-template');
  const clonedLine = $(template).clone(true, true);

  $(clonedLine).attr({ id: '' });
  $(clonedLine).removeClass('hidden');
  $(clonedLine).appendTo(parent);

  if (text.includes('error:')) $(clonedLine).addClass('error');
  else if (text.includes('warning:')) $(clonedLine).addClass('warning');
  $(clonedLine).find('.command-desc-txt').text(text);
};

const appendNewLine = (init = false) => {
  const newLine = currentLine + 1;
  const parent = $('#command-line');
  const template = $('#line-template');
  const clonedLine = $(template).clone(true, true);

  disableCurrentLine();

  $(clonedLine).attr({ id: `line-${newLine}` });
  $(clonedLine).removeClass('hidden');
  $(clonedLine).appendTo(parent);

  if (init) {
    new Typed(`#line-${newLine} .command-desc-txt`, {
      strings: [`octave:${newLine}>`],
      typeSpeed: 50,
    });
  } else {
    $(clonedLine).find('.command-desc-txt').text(`octave:${newLine}>`);
  }

  currentLine++;
  initLine();
  if (!init) focusLine();
};

const onCmdType = (e) => {
  const value = $(e.target).text();

  // Float fix
  if (value.length > 0) $(e.target).removeClass('float');
  else if (!$(e.target).hasClass('float')) $(e.target).addClass('float');
};

const onCmdFocus = (e) => {
  const typedCursor = $(`#line-${currentLine}`).find('.typed-cursor');
  if (typedCursor && !$(typedCursor).hasClass('hidden'))
    $(typedCursor).addClass('hidden');
};

const onCmdRun = async (e) => {
  if (e.which !== 13) return;
  e.preventDefault();

  const value = $(e.target).text().trim();
  if (value.length === 0) {
    appendNewLine();
  } else {
    disableCurrentLine();

    const result = await sendCommand(value, {});
    if (result.content && Array.isArray(result.content)) {
      result.content.forEach((text) => {
        appendNewResult(text);
      });
    }

    appendNewLine();
  }
};

const initCommandLine = () => {
  new Typed('#command-init-txt', {
    strings: ['Initializing . . .', 'GNU Octave, version 4.2.2'],
    typeSpeed: 50,
    showCursor: false,
    onComplete: (self) => {
      appendNewLine(true);
    },
  });
};

const initLine = () => {
  $(`#line-${currentLine}`).find('.command-content').on('input', onCmdType);
  $(`#line-${currentLine}`).find('.command-content').on('keypress', onCmdRun);
  $(`#line-${currentLine}`).find('.command-content').on('focus', onCmdFocus);
};

initCommandLine();
